<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>
<!doctype html>
<html>
    <head>
        <title>Home</title>
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
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="returnvideoh.php" class="btn btn-primary" style="width: 100%; height: 100px; background-color: #558ab7;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="font-size: 30px;" class="glyphicon glyphicon-calendar shadow"></span><br /><span class="menu-text">Return Video History</span></a>
                        </li>
                    </ul>
                </div> <!-- Ending of Left Area -->

                <div class="col-sm-8" style="background-color: #eee; margin-top: 25px;">
                <br />
                    <div>
                        <?php
                            echo MessageVideo();
                            echo SuccessMessageVideo();
                        ?>
                    </div>
                    <form action="returnvideoh.php" class="form-horizontal" enctype="multipart/form-data">
                            <legend>Return Video History</legend>
                            <fieldset>

                                <div class="col-sm-10 col-sm-offset-1 input-group">
                            <div class="input-group">
                              <input type="text" class="form-control" style="padding: 21px; font-size: 20px;" placeholder="Search" name="Search">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" name="SearchButton"><span style="font-size: 26px;" class="glyphicon glyphicon-search shadow"></span></button>
                              </span>
                            </div>
                                </div>

                            </fieldset>
                    </form>
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                    <tr style="background-color: #337ab7; color: #fff;">
                        <th style="vertical-align: middle;">Nr.</th>
                        <th style="vertical-align: middle;">Film Name</th>
                        <th style="vertical-align: middle;">User</th>
                        <th style="vertical-align: middle;">Address</th>
                        <th style="vertical-align: middle;">Date</th>
                        <th style="vertical-align: middle;">Admin</th>
                    </tr>
                    <?php
                        $SrNo=0;
                        if(isset($_GET["SearchButton"]))
                        {
                        $Search=$_GET["Search"];
                        $Query="SELECT filmname, fullname, address, rent.datetime, rent.admin FROM movies, users, rent WHERE rent.id_user=users.id AND rent.id_movie=movies.id AND (filmname LIKE '%$Search%' OR fullname LIKE '%$Search%' OR address LIKE '%$Search%') AND rent.return=1 ORDER BY rent.rdatetime desc";
                        } else {
                        $Query="SELECT filmname, fullname, address, rent.rdatetime, rent.radmin FROM movies, users, rent WHERE (rent.id_user=users.id AND rent.id_movie=movies.id) AND rent.return=1 ORDER BY rent.rdatetime desc";
                        }
                        $Execute = mysqli_query($Connection, $Query);
                        while($DataRows=mysqli_fetch_array($Execute))
                        {
                            $FilmName=$DataRows[0];
                            $FullName=$DataRows[1];
                            $Address=$DataRows[2];
                            $DateTime=$DataRows[3];
                            $Admin=$DataRows[4];
                            $SrNo++;
                    ?>
                    <tr class="<?php if($SrNo%2==0) {echo info;} else {echo success;} ?>">
                        <td style="vertical-align: middle;"><?php echo htmlentities($SrNo); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlentities($FilmName); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlentities($FullName); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlentities($Address); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlentities($DateTime); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlentities($Admin); ?></td>
                    </tr>
                    <?php } ?>
                        </table>
                    </div>
                </div> <!-- Ending of Main Area -->

                <div class="col-sm-2">
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked" style="padding-top: 25px;">
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="addfilm.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-facetime-video shadow"></span><span style="margin-left: -13px;" class="glyphicon glyphicon-plus shadow"></span><br />
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
