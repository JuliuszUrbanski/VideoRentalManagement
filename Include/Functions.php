<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>

<?php
function Move_toVideo($New_Location){
    echo "<script>location='".$New_Location."'</script>";
    exit;
}

function Login_AttemptVideo($Username, $Password){
    $Connection = new mysqli('localhost', 'root', '', 'library');
    $Query = "SELECT * FROM registration 
    WHERE username='$Username' AND password='$Password'";     
    $Execute = mysqli_query ($Connection, $Query);
    if($admin=mysqli_fetch_assoc($Execute)){
        return $admin;
    } else {        
        return 0;
    }
}

function Login() {
    if(isset($_SESSION["User_IdVideo"])){
        return true;
    }
}

function Confirm_LoginVideo(){
    if(!Login()){
        $_SESSION["ErrorMessageVideo"] = "Login Required!";
        Move_toVideo("index.php");
    }
}
?>