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
    $rentid = $_GET['id'];
    $Admin = $_SESSION["UsernameVideo"];

    $querymovie = "SELECT id_movie FROM rent WHERE id='$rentid'";
    $Executemovie = mysqli_query($Connection, $querymovie);
    while($row=mysqli_fetch_array($Executemovie))
    {
      $idmovie = $row['id_movie'];
    }

    $DateTime = strftime("%Y-%m-%d" , $CurrentTime);
    $Query2 = mysqli_query($Connection, "UPDATE movies SET quantityactual=quantityactual+1 WHERE id='$idmovie';");
    $Query = mysqli_query($Connection, "UPDATE rent SET rent.return='1', radmin='$Admin', rdatetime='$DateTime' WHERE id='$rentid';");

    $_SESSION["SuccessMessageVideo"]="The movie has been returned";
      Move_toVideo("returnvideoh.php");

  } else {
    header('Location: index.php');
  }
?>
