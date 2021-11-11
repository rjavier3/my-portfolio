<?php 

$valid_user = "user";
$valid_pass = "password";

$encrypted_pass = password_hash($valid_pass, PASSWORD_DEFAULT);

echo "<p>username: user</p>";
echo "<p>password hint: starts with \"p\"</p>";
 ?>