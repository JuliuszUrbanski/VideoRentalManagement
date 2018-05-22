<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>

<!doctype html>
<html>
    <head>
        <title>User</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-confirmation.min.js"></script>
        <link rel="stylesheet" href="css/adminstyle.css">
        <style>
            body{
                background-color: #777;
            }

            table {
                background-color: #fff;
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
    $ViewQuery = "SELECT * FROM users WHERE id='$PostIDFromURL' ORDER BY datetime desc";
    $Execute = mysqli_query ($Connection, $ViewQuery);
    while($DataRows=mysqli_fetch_array($Execute))
    {
        $UserId=$DataRows['id'];
        $FullName=$DataRows['fullname'];
        $Address=$DataRows['address'];
        $Country=$DataRows['country'];
        $Mobile=$DataRows['mobile'];
        $Email=$DataRows['email'];
        $Admin=$DataRows['admin'];
        $Date=$DataRows['datetime'];
        $Sex=$DataRows['sex'];

?>
        <p style="font-size: 18px; text-align: center; font-weight: bold;">Basic Information
          <a href="edituser.php?id=<?php echo $UserId; ?>"><span class="glyphicon glyphicon-pencil" style="font-size: 15px; padding-left: 10px;"></span></a>
          <a href="#" data-href="deleteuser.php?id=<?php echo $UserId; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-remove-sign" style="color: red; font-size: 16px; padding-left: 10px;"></span></a></p>
    <div class="menu">
        <img src="<?php if($Sex == 'Female'){ echo 'Images/profilf.png';} else {echo 'Images/profilm.png';} ?>" class="photoStyle" width="120" height="120" />
        <p style="font-size: 20px; text-align: center; font-weight: bold; padding-top: 10px;"><?php echo $FullName; ?></p>
    </div>
        <div id="widthmobile" class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Full Name:</th>
                    <td><?php echo $FullName; ?></td>
                </tr>
                <tr>
                    <th>Sex:</th>
                    <td><?php echo $Sex; ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo $Address; ?></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><?php echo $Country; ?></td>
                </tr>
                <tr>
                    <th>Mobile:</th>
                    <td><?php echo $Mobile; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $Email; ?></td>
                </tr>
                <tr>
                    <th>Added by:</th>
                    <td><?php echo $Admin; ?></td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td><?php echo $Date; ?></td>
                </tr>
            </table>
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
        <div class="modal" id="confirm-delete" aria-hidden="true">
            <div class="modal-dialog">
              <center>
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    </div>

                    <div class="modal-body">
                        <p>Do you want to delete the user?</p>
                        <table id="cdelete">
                          <tr><td>Name: </td><td><i><?php echo $FullName; ?></i></td></tr>
                          <tr><td>Address: <i></td><td><?php echo $Address; ?></i></td></tr>
                          <tr><td>Email: <i></td><td><?php echo $Email; ?></i></td></tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
              </center
            </div>
        </div>

        <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>
    </body>
</html>
