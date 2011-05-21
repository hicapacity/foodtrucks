#!/bin/bash
echo 'Create the DB using the provided schema.'
echo 'Then you will need to set the various items in config/main.php'
echo 'Be careful and go through them all!'
echo 'The project was not intended to be user-friendly, nor cleanly done, so pay attention to all parameters.'
echo 'You might need to sift through some views or models or something, which is the idea anyway.  Yii is a nice framework to use'

chmod -R 777 protected/runtime
chmod -R 777 web/assets
echo 'Okay, the log file and assets have been set to wide open permissions!'
