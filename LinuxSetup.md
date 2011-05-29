Ubuntu 11.04
============

Install apache and php
    $ sudo apt-get install apache2 php5 php5-mysql

Enable mod_rewrite
```shell
    $ cd /etc/apache2/mods-enabled/
    $ sudo ln -s ../mods-available/rewrite.load
```

Add the apache directory configuration from the README
    $ sudo nano /etc/apache2/sites-available/default 

Symlink your repository into your web content
    $ cd /var/www
    $ sudo ln -s ~/path/to/repo foodtrucks

Make some of your repository files editable by the apache user
    $ cd ~/path/to/repo
    $ chown -R www-data protected

Restart Apache so the configurations take effect
    sudo /etc/init.d/apache2 restart

And you're done!
