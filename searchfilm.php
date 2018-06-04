<?php
$dbHost = 'localhost';
$dbUsername = 'user';
$dbPassword = 'password';
$dbName = 'database';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = mysqli_query($db, "SELECT * FROM movies WHERE filmname LIKE '%".$searchTerm."%' ORDER BY filmname ASC");
while ($row = mysqli_fetch_array($query)) {
    $data[] = $row['filmname']." | ".$row['year']." | Quantity: ".$row['quantityactual'];
}

//return json data
echo json_encode($data);
?>
