#!/bin/bash

MYSQL_COMMAND=mysql
MYSQL_USER=streetgrindzuser
MYSQL_PWD=dev
MYSQL_DB=streetgrindzapp

# Allow someone to override shell script in home dir
if [ -f $HOME/.streetgrindzconf ]; then
    source $HOME/.streetgrindzconf
fi

# Always nice to let someone see what they are doing. :)
echo -en "\nConnecting to MySQL with command: $MYSQL_COMMAND -u$MYSQL_USER -p$MYSQL_PWD $MYSQL_DB\n\n"

$MYSQL_COMMAND -u$MYSQL_USER -p$MYSQL_PWD $MYSQL_DB
