<?php include "settings.php"; include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home - <?php echo $settings['Title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://bootswatch.com/superhero/bootstrap.css" media="screen">
    <link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css">
    <script>
    function clearFields()
    {
    document.getElementById('inputName').value = "";
    document.getElementById('inputUsername').value = "";
    document.getElementById('inputEmail').value = "";
    document.getElementById('inputPassword').value = "";
    }
    </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand"><?php echo $settings['Title']; ?></a>
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
    </div>


    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1><?php echo $settings['Title']; ?></h1>
            <p class="lead"><?php echo $settings['Slogan']; ?></p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-lg-offset-1">

      <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div></div>

      <div class="col-lg-6" style="padding-left: 5%;">
            <div class="well bs-component">
              <form class="form-horizontal" method="post">
                <fieldset>
                  <legend>Register</legend>
                  <div class="form-group">
                    <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                      <input class="form-control" id="inputUsername" name="username" placeholder="Username" maxlength="50" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-5">
                      <input class="form-control" id="inputName" name="fname" placeholder="First Name" maxlength="60" type="text">
                    </div>
                    <div class="col-lg-5">
                      <input class="form-control" id="inputName" name="lname" placeholder="Last Name" maxlength="60" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                      <input class="form-control" id="inputEmail" name="email" placeholder="Email" maxlength="255" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input class="form-control" id="inputPassword" name="passwd" placeholder="Password" maxlength="255" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="reset" class="btn btn-danger" onclick="clearFields()">Cancel</button>
                      <input type="submit" name="submitBtn" class="btn btn-success">
                    </div>
                  </div>
                </fieldset>
              </form>
              <?php
              if(isset($_POST['submitBtn'])){
                  // password_hash($_POST['passwd'], PASSWORD_DEFAULT, ['cost' => 12]);
                  if(empty($_POST['fname']) OR empty($_POST['lname']) OR empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['passwd'])){
                    echo "Please fill in empty fields.";
                  } elseif($_POST['fname'] > 60 OR $_POST['lname'] > 60 OR $_POST['username'] > 50 OR $_POST['email'] > 255 OR $_POST['passwd'] > 255) {
                    echo "Limit reached. Please change your responses.";
                  } else {
                    if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) === false){
                      echo "You cannot use an email for your username";
                    } else {
                      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
                        echo "Invalid email.";
                      } else {
                      $cost = $settings['bcryptCost'];
                      $hashed_pass = password_hash($_POST['passwd'], PASSWORD_DEFAULT, ['cost' => $cost]);
                      $mysqli = new mysqli($settings['mysql_host'], $settings['mysql_user'], $settings['mysql_pass'],$settings['mysql_db']);
                      // Check if user already exists
                      $email = $_POST['email'];
                      $result = $mysqli->query("SELECT uid FROM users WHERE email = '$email'");

                      if (!$result) {
                        die($mysqli->error);
                      }
                      if ($result->num_rows > 0) {
                        echo "Username/Email in use.";
                      } else {
                        $username = $_POST['username'];
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $ip = getUserIP();
                        $result = $mysqli->query("INSERT IGNORE INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$hashed_pass', '$ip', '".date("Y/m/d")."', '".date("h:i:sa")."')");
                        if($result === false){
                      		echo "Database error, check again later.";
                      	} else {
                      		echo "Registration email sent.";
                      	}
                      }}
                    }
                  }
              }
              ?>
            <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div></div>
          </div>

          </div>

      <footer>
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
              <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
              <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
              <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
              <li><a href="../help/#api">API</a></li>
              <li><a href="../help/#support">Support</a></li>
            </ul>
            <p>Made by <a href="http://thomaspark.co" rel="nofollow">Thomas Park</a>. Contact him at <a href="/cdn-cgi/l/email-protection#c3b7abacaea2b083a1acacb7b0b4a2b7a0abeda0acae"><span class="__cf_email__" data-cfemail="4135292e2c203201232e2e353236203522296f222e2c">[email&#160;protected]</span><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></a>.</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

          </div>
        </div>

      </footer>


    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/custom.js"></script>
  <script type="text/javascript">/* <![CDATA[ */(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);/* ]]> */</script></body>
</html>
