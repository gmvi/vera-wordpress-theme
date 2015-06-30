mysqldump --add-drop-table wordpress | ssh theveraproject.org mysql -p'@aDD6m3Ng@' wordpress
echo 'update wp_options set option_value="http://new.theveraproject.org" where option_name in ("siteurl", "home");' | ssh theveraproject.org mysql -p'@aDD6m3Ng@' wordpress
sudo scp -r /var/www/wordpress/wp-content/uploads theveraproject.org:/var/www/wordpress/wp-content/uploads
