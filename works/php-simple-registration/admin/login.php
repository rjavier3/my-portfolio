<?php
//include("../../../data/data.php");
//include("/u802050120/domains/russelljohnjavier.com/public_html/data/data.php");
//include("/data/data.php");
include("/home/russelljohnjavier.com/data/data.php");

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// echo "$username $password";
	if($username == $valid_user && password_verify($password, $encrypted_pass)){
		session_start();
		$_SESSION['n0j4gl3ds10or8jvcoqbba6smu-russell'] = session_id();
		
		$_SESSION['username'] = $username;
		header('Location:insert.php');
	} else{
		$message = "invalid login. Please try again.";
	}
}

include("../includes/header.php");?>
<main>
	<section>
	<form action="" method="POST">
		<label for="username">Username</label>
		<input type="text" id="username" name="username">

		<label for="password">Password</label>
		<input type="password" id="password" name="password">

		<input type="submit" value="Login" name="login">

	</form>
	<?php 
		if ($message) {
			echo "<p class=\"message\">$message</p>";
		}
	 ?>
	</section>
</main>
<?php include("../includes/footer.php"); ?>