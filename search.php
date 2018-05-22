<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'library';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = mysqli_query($db, "SELECT * FROM users WHERE fullname LIKE '%".$searchTerm."%' OR address LIKE '%".$searchTerm."%' ORDER BY fullname ASC");
while ($row = mysqli_fetch_array($query)) {
    $data[] = $row['fullname']." | ".$row['address'];
}
//return json data
echo json_encode($data);
?>