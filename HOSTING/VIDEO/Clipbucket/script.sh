#!/bin/bash
# Clipbucket install on Ubuntu 18.04 - By Miasmaejuices
## THIS SCRIPT MUST BE LAUNCHED AS ROOT
#https://github.com/MacWarrior/clipbucket-5.0/tree/master/utils

echo ""
echo -ne "Updating Ubuntu system..."
add-apt-repository universe > /dev/null
apt update > /dev/null 2>&1
apt upgrade -y > /dev/null 2>&1
echo -ne " OK"

echo ""
echo -ne "Installing required elements..."
apt-get install php7.2 apache2 mariadb-server php-curl php-imagick ffmpeg gpac php7.2-mysql php7.2-xml php7.2-mbstring sendmail mediainfo -y
/etc/init.d/mysql start > /dev/null
echo -ne " OK"

echo ""
echo -ne "Installing Clipbucket sources..."
mkdir -p /var/www/clipbucket/ && cd "$_"
git clone https://github.com/MacWarrior/clipbucket-5.0.git ./ > /dev/null 2>&1
echo -ne " OK"

echo ""
echo -ne "Updating sources access permissions..."
chown www-data: -R ../clipbucket/
chmod 755 -R ./upload/cache ./upload/files ./upload/images ./upload/includes/langs
chmod 755 ./upload/includes
echo -ne " OK"

echo ""
echo -ne "Adding Softlinks..."
ln -s /usr/bin/ffmpeg /usr/local/bin/ffmpeg
ln -s /usr/bin/MP4Box /usr/local/bin/MP4Box
echo -ne " OK"

echo ""
echo -ne "Generating DB access..."
mysql -uroot -e "CREATE DATABASE clipbucket;"
DB_PASS=$(date +%s | sha256sum | base64 | head -c 16)
mysql -uroot -e "CREATE USER 'clipbucket'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -uroot -e "GRANT ALL PRIVILEGES ON clipbucket.* TO 'clipbucket'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -uroot -e "FLUSH PRIVILEGES;"
echo -ne " OK"
echo ""
echo "- Database address : localhost"
echo "- Database name : clipbucket"
echo "- Database user : clipbucket"
echo "- Database password : ${DB_PASS}"

echo ""
echo -ne "Configuring Apache Vhost..."
cat << 'EOF' > /etc/apache2/sites-available/001-clipbucket.conf
<VirtualHost *:80>
        #ServerName clipbucket.local
        DocumentRoot /var/www/clipbucket/upload/

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

a2ensite 001-clipbucket > /dev/null
a2dissite 000-default > /dev/null
a2enmod rewrite > /dev/null
systemctl reload apache2

cat << 'EOF' >> /etc/apache2/apache2.conf

<Directory /home/http/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
</Directory>
EOF

# Restarting Apache service
systemctl restart apache2 > /dev/null

echo -ne " OK"
echo ""
echo "- Website URL : http://clipbucket.local"

echo ""
echo "Clipbucket installation completed"
echo ""