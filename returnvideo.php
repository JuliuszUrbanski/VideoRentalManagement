<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>
<?php
  date_default_timezone_set("Europe/Warsaw");
  $CurrentTime = time();
  $Now = strftime("%Y-%m-%d" , $CurrentTime);
?>
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

            th {
                height: 40px;
                color: white;
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
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="returnvideo.php" class="btn btn-primary" style="width: 100%; height: 100px; background-color: #558ab7;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-left shadow"></span><br /><span class="menu-text">Return Video</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="issuevideoh.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-calendar shadow"></span><span style="margin-left: -5px; font-size: 30px;" class="glyphicon glyphicon-chevron-right shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-right shadow"></span><br /><span class="menu-text">Issue Video History</span></a>
                        </li>
                        <li style="margin-top: -5px; border-top: 1px solid blue;"><a href="returnvideoh.php" class="btn btn-primary" style="width: 100%; height: 100px;"><span style="font-size: 30px; margin-top: 10px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="margin-left: -13px; font-size: 30px;" class="glyphicon glyphicon-chevron-left shadow"></span><span style="font-size: 30px;" class="glyphicon glyphicon-calendar shadow"></span><br /><span class="menu-text">Return Video History</span></a>
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
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">
                          <legend>Return Video</legend>
                          <fieldset>
                            <div class="input-group" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1" style="background-color: #337ab7; border-color: #337ab7;"><span style="color: white;" class="glyphicon glyphicon-search"></span></span>
                            <input id="myInput" type="text" name="fullname" class="form-control input-md" placeholder="Name" aria-describedby="basic-addon1" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                            </div>
                            <ul id="myUL">
                              <?php
                                $Query = "SELECT fullname, email, id FROM users ORDER BY fullname ASC;";
                                $Execute = mysqli_query($Connection, $Query);
                                while($DataRows=mysqli_fetch_array($Execute))
                                {
                                  $id = $DataRows[2];
                                  $FullName=$DataRows[0];
                                  $Email=$DataRows[1];
                              ?>
                                <li><a href="returnvideo.php?change=<?php echo htmlentities($id); ?>"><?php echo htmlentities($FullName)." | ".htmlentities($Email); ?></a></li>
                              <?php } ?>
                            </ul>
                          </fieldset><br />
                          <br />
                          <?php
                          if(isset($_GET['change']))
                          {
                          ?>
                          <div class="table-responsive">
                            <table class="table table-striped table-hover">
                              <tr style="background-color: #337ab7;">
                                <th>Nr.</th>
                                <th>Film Name</th>
                                <th>Date</th>
                                <th>Action</th>
                              </tr>

                              <?php
                                  $replace = $_GET['change'];
                                  $SrNo=0;
                                  $Query="SELECT rent.id, filmname, rent.datetime FROM rent, movies, users WHERE ((rent.id_user=users.id AND rent.id_movie=movies.id) AND users.id='$replace') AND rent.return='0' ORDER BY rent.datetime desc";

                                  $Execute = mysqli_query($Connection, $Query);
                                  while($DataRows=mysqli_fetch_array($Execute))
                                  {
                                    $rentid=$DataRows['id'];
                                    $FilmName=$DataRows['filmname'];
                                    $DateTime=$DataRows[2];
                                    $SrNo++;
                              ?>

                              <tr class="<?php if($SrNo%2==0) {echo info;} else {echo success;} ?>">
                                <td style="vertical-align: middle;"><?php echo $SrNo; ?></td>
                                <td style="vertical-align: middle;"><?php echo $FilmName; ?></td>
                                <td style="vertical-align: middle; <?php
                                  if(date('Y-m-d', strtotime("+30 days", strtotime($DateTime))) <= $Now) { echo 'color: red'; } ?>">
                                  <?php echo htmlentities($DateTime); ?>
                                </td>
                                <td><a href="return.php?id=<?php echo $rentid; ?>"><span style="font-size: 20px; transform: scaleX(-1); -moz-transform: scaleX(-1); -webkit-transform: scaleX(-1); -ms-transform: scaleX(-1);" class="glyphicon glyphicon-repeat"></span></a></td>
                              </tr>

                            <?php } ?>

                            </table>
                          </div>
                        <?php } ?>
                  </form>
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
<script>
  function myFunction() {
      var input, filter, ul, li, a, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName("li");
      for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";

          }
      }
  }
</script>
    </body>
</html>
