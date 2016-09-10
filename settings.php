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
// If you wish to change navbar colors:
// navbar-inverse = orange
// navbar-default = black
$settings['Navbar'] = '<div class="navbar default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="../" class="navbar-brand"><?php echo $settings["Title"]; ?></a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li>
          <a href="../help/">Help</a>
        </li>
        <li>
          <a href="http://news.bootswatch.com">Blog</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
        <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
      </ul>

    </div>
  </div>
</div>';

// Server settings
date_default_timezone_set('Pacific/Auckland');

// Backend settings
$settings['bcryptCost'] = 12;
$settings['mysql_host'] = "localhost";
$settings['mysql_user'] = "root";
$settings['mysql_pass'] = "";
$settings['mysql_db'] = "socialnetwork";
?>
