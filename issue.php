<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_LoginVideo(); ?>

<?php
    if($_POST)
    {
        date_default_timezone_set("Europe/Warsaw");
        $CurrentTime = time();
        $DateTime = strftime("%Y-%m-%d" , $CurrentTime);
        $name = $_POST['fullname'];
        $movie = $_POST['filmname'];
        $Admin = $_SESSION["UsernameVideo"];
        $check = explode(" | ",$name);
        $checkfilm = explode(" | ",$movie);

        $queryname = "SELECT id FROM users WHERE fullname='$check[0]' AND address='$check[1]'";
        $Execute = mysqli_query($Connection, $queryname);
        while($row=mysqli_fetch_array($Execute))
        {
            $id = $row['id'];
        }

        $querymovie = "SELECT id, quantityactual FROM movies WHERE filmname='$checkfilm[0]' AND year='$checkfilm[1]'";
        $Executemovie = mysqli_query($Connection, $querymovie);
        while($row=mysqli_fetch_array($Executemovie))
        {
            $idmovie = $row['id'];
            $actual = $row['quantityactual'];
        }

        if($actual > 0){
            $query = mysqli_query($Connection, "INSERT INTO rent(id_user, id_movie, datetime, admin) values('$id', '$idmovie', '$DateTime', '$Admin')");
            $query2 = mysqli_query($Connection, "UPDATE movies SET quantityactual=quantityactual-1 WHERE id='$idmovie'");
            $_SESSION["SuccessMessageVideo"]="The movie has been rented";
              Move_toVideo("issuevideoh.php");
        } else
        {
            $_SESSION["ErrorMessageVideo"]="Error! Check the number of available movies";
              Move_toVideo("issuevideo.php");
        }

    } else {
        header('Location: index.php');
    }
?>
