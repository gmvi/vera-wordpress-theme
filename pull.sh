ssh theveraproject.org mysqldump -p'@aDD6m3Ng@' --add-drop-table wordpress | mysql wordpress
echo 'update wp_options set option_value="http://hedberg" where option_name in ("siteurl", "home");' | mysql wordpress
sudo scp -r theveraproject.org:/var/www/wordpress/wp-content/uploads /var/www/wordpress/wp-content/uploads
