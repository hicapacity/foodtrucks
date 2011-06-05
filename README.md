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
  mysql -u streetgrindzuser -pdev streetgrindzapp < sql/streetgrindzapp.sql
```

I forgot to add the rewrites to remove index, I do it in the Apache vhost config, you might wish to do it in .htaccess.

If you set a different mysql password than dev you need to set the password in config/console.php and config/main.php

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

(If you're using shared hosting a .htaccess file is already setup in web/.htaccess)

You will need PHP 5 and MySQL (since the dump file provided is MySQL). 

Run the install script, set up the DB, set the config file(s) as specified, point your web root to the web folder, and that should be it!

PHP 5 Setup
===========

If you encounter an error about date() when first accessing the site, you'll 
have to edit your php.ini file and uncomment ``date.timezone``
and set it to the following: 

``date.timezone = 'Pacific/Honolulu'``

If you encounter PHP Fatal error:  Call to undefined function curl_init(), you
need to install libcurl.

Application Setup
=================

Since we have a dependency to a submodule, please run:

``git submodule init``

and:

``git submodule update``

from the root of the project

To get a sample truck/tweet, first you must add some valid twitter accounts.  
To do this, navigaate to http://yoursite.com/site/login.
The user accounts are configured in the protected/config/main.php file (this will move to another file).
Once logged in, you can then manage the twitter accounts.
Finally, after you have added some twitter accounts, please run from root/protected:

``./yiic queryfoodtruck``

Block Diagram
=============

![Block diagram of system](https://docs.google.com/drawings/pub?id=17EyP7j0F2t8dCOWSTPzzhh-TYtaI4mLNcs3pEZvhQvk&w=480&h=360)
