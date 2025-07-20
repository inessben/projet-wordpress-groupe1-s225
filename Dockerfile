FROM wordpress:latest

# Active mod_rewrite
RUN a2enmod rewrite

# Force AllowOverride All dans la config Apache
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
