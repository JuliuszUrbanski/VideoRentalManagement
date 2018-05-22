<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>

<?php
  if(isset($_POST["Submit"]))
  {
      $FilmName=mysqli_real_escape_string($Connection, $_POST["filmname"]);
      $Director=mysqli_real_escape_string($Connection, $_POST["director"]);
      $Genres=mysqli_real_escape_string($Connection, $_POST["genres"]);
      $Country=mysqli_real_escape_string($Connection, $_POST["country"]);
      $RunTime=mysqli_real_escape_string($Connection, $_POST["runtime"]);
      $QuantityActual=mysqli_real_escape_string($Connection, $_POST["quantity"]);
      $Quantity=mysqli_real_escape_string($Connection, $_POST["quantity"]);
      $Description=mysqli_real_escape_string($Connection, $_POST["description"]);
        date_default_timezone_set("Europe/Warsaw");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S" , $CurrentTime);
        $Admin = $_SESSION["UsernameVideo"];
    if(empty($FilmName) || empty($Director) || empty($Genres) || empty($Country) || empty($RunTime) || empty($Quantity)) {
          $_SESSION["ErrorMessageVideo"] = "All fields must be filled out";
          Move_toVideo("addfilm.php");

    } else {
          $Query = "INSERT INTO movies(filmname,director,genres,country,runtime,quantityactual,quantity,description,datetime,admin)
                    VALUES('$FilmName', '$Director', '$Genres', '$Country', '$RunTime', '$QuantityActual', '$Quantity', '$Description', '$DateTime', '$Admin')";
          $Execute = mysqli_query ($Connection, $Query);
          if($Execute){
              $_SESSION["SuccessMessageVideo"]="Film Added Successfully";
              Move_toVideo("addfilm.php");
          } else {
              $_SESSION["ErrorMessageVideo"] = "Something Went Wrong. Try Again !";
              Move_toVideo("addfilm.php");
          }
      }
  }
?>

<!doctype html>
<html>
    <head>
        <title>Add Film</title>
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
                            <form action="addfilm.php" class="form-horizontal" method="post" enctype="multipart/form-data" style="">
                                <legend>Add New Film</legend>
                                <fieldset>

                            <div class="col-sm-10 col-sm-offset-1 input-group">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-film"></span></span>
                                <input type="text" name="filmname" class="form-control input-lg" placeholder="Film Name" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-pencil"></span></span>
                                <input type="text" name="director" class="form-control input-lg" placeholder="Director" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-list"></span></span>
                                <input type="text" name="genres" class="form-control input-lg" placeholder="Genres" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-globe"></span></span>
                                <input type="text" name="country" class="form-control input-lg" placeholder="Country" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-time"></span></span>
                                <input type="text" name="runtime" class="form-control input-lg" placeholder="Runtime (eg. 135 min)" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-sort-by-order"></span></span>
                                <input type="number" name="quantity" class="form-control input-lg" placeholder="Quantity" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 input-group padding">
                                <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-edit"></span></span>
                                <textarea name="description" class="form-control vresize" rows="5" id="comment" placeholder="Description"></textarea>
                            </div>
                                <br />
                            <input class="col-sm-4 col-sm-offset-4 btn btn-primary btn-md" type="submit" name="Submit" value="Add New Film">
                                </fieldset>
                                <br />
                            </form>
                </div> <!-- Ending of Main Area -->

                <div class="col-sm-2">
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked" style="padding-top: 25px;">
                        <li><a href="addfilm.php" class="btn btn-primary" style="width: 100%; height: 100px; background-color: #558ab7;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-facetime-video shadow"></span><span style="margin-left: -13px;" class="glyphicon glyphicon-plus shadow"></span><br />
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
