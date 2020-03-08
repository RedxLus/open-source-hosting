#!/bin/sh
UPDATE_SCRIPT=/usr/share/awstats/tools/update.sh
if [ -x $UPDATE_SCRIPT ]
then
  su -l -c $UPDATE_SCRIPT www-data
fi
