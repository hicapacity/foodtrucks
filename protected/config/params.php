<?php 

return array(
    // this is used in contact page
    'siteName'=>'Streetgrindz',
    'poweredBy'=>'HI Capacity',
    'poweredByUrl'=>'http://hicapacity.org',
    'adminEmail'=>'maker@hicapacity.org',
    'contactEmail'=>'maker@hicapacity.org',
    'analytics'=>'UA-22988834-2',

    //TODO - CHANGE THIS from 'trucks' to something more generic
    //maybe change it to something like 'credentials'
    'trucks' => require( dirname( __FILE__ ) . '/foodtruck.php' ),

    //TODO - MOVE THIS to the above include file after you rename it.
    'adminAccounts'=>array(
        // username => password
        'streetgrindzuser' => 'dev',
        'a130%_!#35i350' => 'mbdp109!25_@',
    ),

);
