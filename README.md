MYSQL SETUP
===========

Note: mysql is not required to run the app yet

Create your dev mysql using the following:

```mysql
  mysql> create database streetgrindzapp;
  mysql> grant all on streetgrindzapp.* to streetgrindzuser@localhost identified by 'dev';
  mysql> exit
```

Grab the recent dump:

```mysql
  mysql -ustreetgrindzuser -pdev streetgrindzapp < sql/streetgrindzapp.sql
```

I forgot to add the rewrites to remove index, I do it in the Apache vhost config, you might wish to do it in .htaccess.

Apache Setup
===========

Example apache vhost config (please edit Directory as needed):

```apache
    <Directory /var/www/foodtrucks/web>
        IndexIgnore */*
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php

        Options +FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
```

You will need PHP 5 and MySQL (since the dump file provided is MySQL). 

Run the install script, set up the DB, set the config file(s) as specified, point your web root to the web folder, and that should be it!

PHP 5 Setup
===========

If you encounter an error about date() when first accessing the site, you'll 
have to edit your php.ini file and uncomment ``date.timezone``
and set it to the following: 

``date.timezone = 'Pacific/Honolulu'``
