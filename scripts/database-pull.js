// imports
const fs = require('fs-extra');
const path = require('path');
const https = require('https');
const tar = require('tar-fs');
const mysql = require('mysql');
const readline = require('readline');
const zlib = require('zlib');

// paths
const tmp = path.join(__dirname, 'tmp');
const uploads_dir = path.join(__dirname, '..', '..', '/uploads');
const wp_config = path.join(__dirname, '..', '..', '..', '..', 'wp-config.php');

// read database connection info from wp-config.php
const regex_db = /define\('DB_NAME', ([^)]+)\);\s*$/
const regex_user = /define\('DB_USER', ([^)]+)\);\s*$/
const regex_pass = /define\('DB_PASSWORD', ([^)]+)\);\s*$/
var mysqlUser;
var mysqlPass;
var mysqlDB;
const rl = readline.createInterface({
  input: fs.createReadStream(wp_config),
  crlfDelay: Infinity,
});
rl.on('line', (line) => {
  var match;
  match = line.match(regex_db);
  if (match) mysqlDB = eval(match[1]);
  match = line.match(regex_user);
  if (match) mysqlUser = eval(match[1]);
  match = line.match(regex_pass);
  if (match) mysqlPass = eval(match[1]);
  if (mysqlDB && mysqlUser && mysqlPass) rl.close();
});

rl.on('close', () => {
  // connect to database to get siteurl option
  const conn = mysql.createConnection({
    host: 'localhost',
    user: mysqlUser,
    password: mysqlPass,
    database: mysqlDB,
    multipleStatements: true,
  });
  conn.connect();
  
  conn.query('SELECT option_value FROM wp_options WHERE option_name = "siteurl"', (err, res) => {
    var siteurl = res[0].option_value;
    // get database backup
    https.get({
      hostname: 'vera.alephnil.net',
      path: '/database-pull.php?siteurl='+encodeURIComponent(siteurl),
      auth: 'vera:local46',
    }, function(response) {
      fs.mkdirpSync(tmp);
      response.pipe(zlib.createUnzip()).pipe(tar.extract(tmp)).on('finish', () => {
        if (!fs.existsSync(path.join(tmp, 'uploads')) ||
            !fs.existsSync(path.join(tmp, 'database.sql'))) {
          console.error("database incomplete");
          process.exit(1);
        }
        fs.removeSync(uploads_dir);
        fs.copySync(path.join(tmp, 'uploads'), uploads_dir);
        fs.readFile(path.join(tmp, 'database.sql'), 'utf8', (err, data) => {
          if (err) throw err;
          conn.query(data, (err, res) => {
            if (err) throw err;
          });
          conn.end();
        });
      })
    });
  });
});
