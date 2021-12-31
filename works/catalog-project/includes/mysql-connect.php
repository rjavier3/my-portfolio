<?php 

//connect to the database
$server = "localhost";
$database = "u802050120_php_db";
$username = "u802050120_php_db";
$password = "5GqVDEm0$#vf";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
} else{
    //echo "connection good";
} 

if (!defined("BASE_URL")) {
    define("BASE_URL", "https://russelljohnjavier.com/works/catalog-project/");
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