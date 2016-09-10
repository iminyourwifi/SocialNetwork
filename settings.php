<?php

//  Settings  //

// Relevant to Page
$settings['Title'] = "WatchBook";
$settings['startupYear'] = 2016;
$settings['Slogan'] = "Connecting people together since ".$settings['startupYear'];

// Server settings
date_default_timezone_set('Pacific/Auckland');

// Backend settings
$settings['bcryptCost'] = 12;
$settings['mysql_host'] = "localhost";
$settings['mysql_user'] = "root";
$settings['mysql_pass'] = "";
$settings['mysql_db'] = "socialnetwork";
?>
