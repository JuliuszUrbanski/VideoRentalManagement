<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>

<?php
  if(!$_GET)
  {
    Move_toVideo("allusers.php");
  } else {
    $PostIDFromURL=$_GET["id"];
  }
  if(isset($_POST["Submit"]))
  {
      $FullName=mysqli_real_escape_string($Connection, $_POST["Fullname"]);
      $Address=mysqli_real_escape_string($Connection, $_POST["Address"]);
      $Country=mysqli_real_escape_string($Connection, $_POST["Country"]);
      $Mobile=mysqli_real_escape_string($Connection, $_POST["Mobilenumber"]);
      $Email=mysqli_real_escape_string($Connection, $_POST["Email"]);
      $Sex=mysqli_real_escape_string($Connection, $_POST["Sex"]);
        date_default_timezone_set("Europe/Warsaw");
        $CurrentTime = time();
        $DateTime = strftime("%d-%B-%Y" , $CurrentTime);
        $Admin = $_SESSION["UsernameVideo"];
    if(empty($FullName) || empty($Address) || empty($Country) || empty($Mobile) || empty($Email)) {
          $_SESSION["ErrorMessageVideo"] = "All fields must be filled out";
          Move_toVideo("edituser.php?id=".$PostIDFromURL);
    } else {
          $Query = "UPDATE users SET fullname='$FullName', address='$Address', country='$Country', mobile='$Mobile', email='$Email', sex='$Sex' WHERE id='$PostIDFromURL'";

          $Execute = mysqli_query ($Connection, $Query);
          if($Execute){
              $_SESSION["SuccessMessageVideo"]="User Updated Successfully";
              Move_toVideo("user.php?id=".$PostIDFromURL);
          } else {
              $_SESSION["ErrorMessageVideo"] = "Something Went Wrong. Try Again !";
              Move_toVideo("user.php?id=".$PostIDFromURL);
          }
      }
  }
?>

<!doctype html>
<html>
    <head>
        <title>Edit User</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyle.css">
        <style>
            body{
                background-color: #777;
            }

            table {
                background-color: #fff;
            }

            .menu img {
                margin-top: 105px;
            }

            .table-r {
                float:center;
                text-align: left;
                width: 50%;
                margin: 0 auto;
            }
            input {
                width: 100%;
            }
            @media only screen and (max-width: 900px) {
                .menu {
                    margin-top: -95px;
                    margin-left: 0px;
                    padding: 0px;
                    float: none;
                    width: 100%;
                }
                .table-r {
                    width: 100%;
                }
                input {
                    width: 100%;
                }
            }
            @media only screen and (max-width: 767px) {
                .subbtn {
                    margin-top: 10px;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light" role="navigation" style="background-color: #6BBCED;">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <img class="img-responsive" style="margin-top: -5px;" src="Images/Logo.png" width="380">
                    </a>
                </div>
                <div style="margin-top: 5px;">
            <ul id="logout" class="nav navbar-nav navbar-right">
      <li style="color: #555; padding-top: 15px;"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["UsernameVideo"]; ?></li>
      <li><a href="logout.php" style="color: #aff; background-color:transparent;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
                </div>
            </div>
        </nav>

<div class="line" style="height: 10px; background: #6BBCED; border-bottom: 2px solid #1DA4CF;"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked" style="padding-top: 25px;">
                        <li><a href="dashboard.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-th shadow"></span><br /><span class="menu-text">Dashboard</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="issuevideo.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-right shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-right shadow"></span><br /><span class="menu-text">Issue Video</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="returnvideo.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-left shadow"></span><br /><span class="menu-text">Return Video</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="issuevideoh.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-calendar shadow"></span><span style="margin-left: -5px; font-size: 30px;" class="glyphicon glyphicon-chevron-right shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-right shadow"></span><br /><span class="menu-text">Issue Video History</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="returnvideoh.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="font-size: 30px;" class="glyphicon glyphicon-calendar shadow"></span><br /><span class="menu-text">Return Video History</span></a>
                        </li>
                    </ul>
                </div> <!-- Ending of Left Area -->

                <div class="col-sm-8" style="background-color: #eee; margin-top: 25px;">
                    <br />
                        <?php
                            echo MessageVideo();
                            echo SuccessMessageVideo();
                        ?>
<?php
    $PostIDFromURL=$_GET["id"];
    $ViewQuery = "SELECT * FROM users WHERE id='$PostIDFromURL'";
    $Execute = mysqli_query ($Connection, $ViewQuery);
    while($DataRows=mysqli_fetch_array($Execute))
    {
        $FullNameToBeUpdate=$DataRows['fullname'];
        $AddressToBeUpdate=$DataRows['address'];
        $CountryToBeUpdate=$DataRows['country'];
        $MobileToBeUpdate=$DataRows['mobile'];
        $EmailToBeUpdate=$DataRows['email'];
        $AdminToBeUpdate=$DataRows['admin'];
        $DateToBeUpdate=$DataRows['datetime'];
        $SexToBeUpdate=$DataRows['sex'];
?>
<p style="font-size: 18px; text-align: center; font-weight: bold;">Basic Information</p>
    <div class="menu">
        <img src="<?php if($SexToBeUpdate == 'Female'){ echo 'Images/profilf.png';} else {echo 'Images/profilm.png';} ?>" class="photoStyle" width="120" height="120" />
        <p style="font-size: 20px; text-align: center; font-weight: bold; padding-top: 10px;"><?php echo $FullNameToBeUpdate; ?></p>
    </div>
        <div class="table-responsive table-r">
    <form action="edituser.php?id=<?php echo $PostIDFromURL; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Full Name:</th>
                    <td><input type="text" name="Fullname" value="<?php echo $FullNameToBeUpdate; ?>" /></td>
                </tr>
                <tr>
                    <th>Sex:</th>
                    <td><select name="Sex">
                        <option value="Male">Male</option>
                        <option value="Female" <?php if($SexToBeUpdate=="Female") { echo "selected"; } ?>>Female</option>
                    </select></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><input type="text" name="Address" value="<?php echo $AddressToBeUpdate; ?>" /></td>
                </tr>
                <tr>
                    <th>Country:</th>
                    <td><input type="text" name="Country" value="<?php echo $CountryToBeUpdate; ?>" /></td>
                </tr>
                <tr>
                    <th>Mobile:</th>
                    <td><input type="text" name="Mobilenumber" value="<?php echo $MobileToBeUpdate; ?>" /></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><input type="text" name="Email" value="<?php echo $EmailToBeUpdate; ?>" /></td>
                </tr>
                <tr>
                    <th>Added by:</th>
                    <td><input type="text" value="<?php echo $AdminToBeUpdate; ?>" disabled /></td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td><input type="text" value="<?php echo $DateToBeUpdate; ?>" disabled /></td>
                </tr>
            </table>

            <input type="submit" name="Submit" class="col-sm-4 col-sm-offset-8 btn btn-success subbtn" value="Save" />
            </form>
        </div>
    <?php } ?>

    <hr>
                </div> <!-- Ending of Main Area -->

                <div class="col-sm-2">
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked" style="padding-top: 25px;">
                        <li><a href="addfilm.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-facetime-video shadow"></span><span style="margin-left: -13px;" class="glyphicon glyphicon-plus shadow"></span><br />
                            <span class="menu-text">Add Film</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="adduser.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-user shadow"></span><span style="margin-left: -13px; font-size: 15px;" class="glyphicon glyphicon-plus shadow"></span><br /><span class="menu-text">Add User</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="allusers.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-user shadow"></span><span style="margin-left: -13px; font-size: 20px;" class="glyphicon glyphicon-user shadow"></span><br />
                            <span class="menu-text">All Users</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="allfilms.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-folder-open shadow"></span><br />
                            <span class="menu-text">All Films</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="logout.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-log-in shadow"></span><br />
                            <span class="menu-text">Logout</span></a>
                        </li>
                    </ul>
                </div> <!-- Ending of Right Area -->
            </div> <!-- Ending of Row -->

        </div> <!-- Ending of Container -->
    </body>
</html>
