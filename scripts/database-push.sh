#!/usr/bin/env bash

PARENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null && pwd )"
CREDENTIALS="$PARENT_DIR/credentials"
TMP="/tmp/vera-backup"
if [[ ! -f $CREDENTIALS/local || ! -f $CREDENTIALS/staging ]]; then
	echo "Can't find proper credentials"
	exit 1
fi
source $CREDENTIALS/local
source $CREDENTIALS/staging
mkdir -p $TMP

# make database backup, ignoring certain tables
echo "dumping database"
mysqldump --protocol="TCP" -u"$DB_USER" -p"$DB_PASS" \
          --ignore-table="$DB_NAME.wp_users" \
          --ignore-table="$DB_NAME.wp_usermeta" \
          "$DB_NAME" \
	> $TMP/database.sql

# update the backup file to match staging server expectations
sed -i "s|\\(INSERT INTO \`wp_options\`.*([0-9]*,'siteurl','\\)[^']*'|\1http://$STAGING_HOST'|" $TMP/database.sql
sed -i "s|\\(INSERT INTO \`wp_options\`.*([0-9]*,'home','\\)[^']*'|\1http://$STAGING_HOST'|" $TMP/database.sql

# copy uploads directory
echo "copying uploads"
cp -a $WORDPRESS/wp-content/uploads/ $TMP/

# replay backup into the staging server
echo "uploading"
tar -czf - -C $TMP uploads database.sql \
    | sshpass -p "$STAGING_PASSWORD" ssh $STAGING_USER:@$STAGING_HOST '~/scripts/receive_push.sh'

echo "done"
