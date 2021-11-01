#!/bin/bash
#
USER="usuario_responsiva"
PASSWORD="responsivas-2020"
DATABASE="bd_responsivas"
date=$(date +"%Y-%m-%d")
PATH_OUTPUT="/var/www/html/responsivas/resp_bd/backup"
mysqldump --user=$USER --password=$PASSWORD $DATABASE > $PATH_OUTPUT/$DATABASE-$date.sql
gzip $PATH_OUTPUT/$DATABASE-$date.sql

find $PATH_OUTPUT/* -mtime +30 -exec rm {} \;
