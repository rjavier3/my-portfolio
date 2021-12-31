<?php 

//connect to the database
$server = "localhost";
$username = "rjavier3";
$password = "mzC4CjFyUmAYWz5";
$database = "rjavier3";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
} else{
    //echo "connection good";
} 

if (!defined("BASE_URL")) {
    define("BASE_URL", "https://rjavier3.dmitstudent.ca/dmit2025-a02/catalog-project/");
}

if (!defined("THIS_PAGE")) {
    define("THIS_PAGE", $_SERVER['PHP_SELF']);
}

//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
 $_POST[$key] = mysqli_real_escape_string($conn,$value);
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
 $_GET[$key] = mysqli_real_escape_string($conn,$value);
 }

 ?>