<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>

<?php
  if($_GET)
  {
    date_default_timezone_set("Europe/Warsaw");
    $CurrentTime = time();
    $DateTime = strftime("%Y-%m-%d" , $CurrentTime);
    $userid = $_GET['id'];
    $Admin = $_SESSION["UsernameVideo"];

    $querymovie = "SELECT id_movie FROM rent WHERE id_user='$userid' AND rent.return='0'";
    $result = mysqli_query($Connection, $querymovie);
    if(mysqli_num_rows($result) > 0)
    {
      $_SESSION["ErrorMessageVideo"]="Person must return all films!";
      Move_toVideo("user.php?id=$userid.php");
    } else {
      $Query = mysqli_query($Connection, "DELETE FROM users WHERE id='$userid'");
      $Query2 = mysqli_query($Connection, "DELETE FROM rent WHERE id_user='$userid'");
      $_SESSION["SuccessMessageVideo"]="Person has been deleted!";
      Move_toVideo("allusers.php");
    }

  } else {
    header('Location: index.php');
  }
?>
