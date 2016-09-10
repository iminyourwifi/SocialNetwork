<?php

//  Settings  //

// Relevant to Page
$settings['Title'] = "WatchBook";
$settings['startupYear'] = 2016;
$settings['Slogan'] = "Connecting people together since ".$settings['startupYear'];
$settings['Footer'] = '      <footer>
        <div class="row">
          <div class="col-lg-12" style="padding-left: 1.5%;">

            <ul class="list-unstyled">
              <li><a href="https://twitter.com/iminyourwifi">Twitter</a></li>
              <li><a href="https://github.com/iminyourwifi/SocialNetwork">GitHub</a></li>
              <li><a href="https://github.com/iminyourwifi/SocialNetwork/issues">Support</a></li>
            </ul>
            <p>Code released under the <a href="https://github.com/iminyourwifi/SocialNetwork/blob/master/README.md">MIT License</a>.</p>
            <p>Theme created by <a href="https://thomaspark.co/">Thomas Park</a>.</p>
            <p>Copyright (C) '.date("Y").'-'.$settings['startupYear'].' Copyright Holder All Rights Reserved.<p>
          </div>
        </div>

      </footer>';

// Server settings
date_default_timezone_set('Pacific/Auckland');

// Backend settings
$settings['bcryptCost'] = 12;
$settings['mysql_host'] = "localhost";
$settings['mysql_user'] = "root";
$settings['mysql_pass'] = "";
$settings['mysql_db'] = "socialnetwork";
?>
