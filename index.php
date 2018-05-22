<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
    if(Login()){
        Move_toVideo("dashboard.php");
    }    
?>


<?php
if(isset($_POST["Submit"]))
{
      $Username=mysqli_real_escape_string($Connection, $_POST["Username"]);
      $Password=mysqli_real_escape_string($Connection, $_POST["Password"]);
      
    if(empty($Username) || empty($Password)) {
          $_SESSION["ErrorMessageVideo"] = "All Fields must be filled out";
          Move_toVideo("index.php");    
    } 
    else {
        $Found_Account=Login_AttemptVideo($Username,$Password);
        $_SESSION["User_IdVideo"]=$Found_Account["id"];
        $_SESSION["UsernameVideo"]=$Found_Account["username"];
        
        if($Found_Account)
        {
          Move_toVideo("dashboard.php");
        } else {
          $_SESSION["ErrorMessageVideo"] = "Invalid Username / Password";
        }
    }
}
?>

<!doctype html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyle.css">
        <style>
            body{
                background-color: #eee;
            }
            form{
                border: 2px solid #1DA4CF;
                border-radius: 20px;
                padding: 40px 40px 20px 40px;
                background-color: #6BBCED;
            }
        </style>
    </head>
    <body>        
        <nav class="navbar navbar-light" role="navigation" style="background-color: #6BBCED; padding: 0 0px 25px 0px;">
            <div class="container col-sm-offset-3 col-sm-6">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <img class="img-responsive" style="margin-top: -5px;" src="Images/Logo.png" width="540">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="collapse"></div>
            </div>
        </nav>
        
<div class="line" style="height: 10px; background: #6BBCED; border-bottom: 2px solid #1DA4CF;"></div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <br /><br /><br /><br />
                        <?php 
                            echo MessageVideo(); 
                            echo SuccessMessageVideo();    
                        ?>
                        <div>      
                            <form action="index.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                            <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user text-primary"></span>
                            </span>                                        
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                            </div>    
                                    </div>
                                    
                                    <div class="form-group">
                            <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock text-primary"></span>
                            </span>                                        
                            <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                            </div>
                                    </div>                                   
                                <br />
                            <input class="btn btn-success btn-block btn-lg" type="submit" name="Submit" value="Login">
                                </fieldset>
                                <br />
                            </form>
                    </div>
                </div> <!-- Ending of Main Area -->
                
            </div> <!-- Ending of Row -->
            
        </div> <!-- Ending of Container -->
    </body>
</html>