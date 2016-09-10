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

      <center
      <div class="col-lg-6" style="padding-left: 5%;">
            <div class="well bs-component">
              <form class="form-horizontal" method="post">
                <fieldset>
                  <legend>Login</legend>
                  <div class="form-group">
                    <label for="inputUsername" class="col-lg-2 control-label">Login</label>
                    <div class="col-lg-10">
                      <input class="form-control" id="inputUsername" name="login" placeholder="Username/Email" maxlength="255" type="text">
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
                      <input type="submit" name="submitBtn" class="btn btn-success" value="Login">
                    </div>
                  </div>
                </fieldset>
              </form>
              <?php
                if(isset($_POST['submitBtn'])){
                  if(EMPTY($_POST['login']) OR empty($_POST['passwd'])){
                    echo "Please fill in empty fields.";
                  } else {
                    if(!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL) === false){
                      // Go Go Gadget Email
                      $cost = $settings['bcryptCost'];
                      $mysqli = new mysqli($settings['mysql_host'], $settings['mysql_user'], $settings['mysql_pass'],$settings['mysql_db']);

                      $sql = "SELECT * FROM Users WHERE `email` = '".$_POST['login']."'";
                      $result = $mysqli->query($sql);
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          $db_pass = $row['password'];
                          if(password_verify($_POST['passwd'], $db_pass)){
                            echo "Logged in";
                          } else {
                            echo "Incorrect password";
                          }
                        }
                      } else {
                        echo "Incorrect Login.";
                      }
                    } else {
                      // Go Go Gadget Username
                      $cost = $settings['bcryptCost'];
                      $mysqli = new mysqli($settings['mysql_host'], $settings['mysql_user'], $settings['mysql_pass'],$settings['mysql_db']);

                      $sql = "SELECT * FROM Users WHERE `username` = '".$_POST['login']."'";
                      $result = $mysqli->query($sql);
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          $db_pass = $row['password'];
                          if(password_verify($_POST['passwd'], $db_pass)){
                            echo "Logged in";
                          } else {
                            echo "Incorrect password";
                          }
                        }
                      } else {
                        echo "Incorrect Login.";
                      }
                    }
                  }
                }
              ?>
            <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div></div>
          </div>
        </center>

          </div>

          <?php echo $settings['Footer']; ?>


    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://bootswatch.com/assets/js/custom.js"></script>
</html>
