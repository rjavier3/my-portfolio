<?php
//uername: michelle  
//password: Password1
$page_title = "login";
$body_class = "login";
require("../includes/mysql-connect.php");

if (isset($_POST['login-btn'])) {
	$user = trim($_POST['user']);
	$pswd = trim($_POST['password']);

	if ($user && $pswd) {
		$login_sql = "SELECT u_id, first_name, password from a2_users WHERE user_name ='$user' OR email = '$user'";
		$login_result = $conn->query($login_sql);
		if ($login_result->num_rows > 0) {
			$row = $login_result->fetch_assoc();

			if (password_verify($pswd, $row['password'])) {
				session_start();
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['user_id'] = $row['u_id'];
				$_SESSION['qwertyuiopasdfghjklZXCVBNM-2'] = session_id();

				$_SESSION['time'] = time();

				$update_sql = "UPDATE a2_users SET date_last_login = NOW() WHERE u_id = " . $_SESSION['user_id'];
				if ($conn->query($update_sql)) {
						header("location:".BASE_URL."index.php?m=loggedin");
				} else{
					$message = "<p>These was a problem. conn->error</p>";
				}
			} else{
				$message .= "<p>password don't match</p>";
			}
		} else{
			$message .= "<p>Invalid username or password</p>";
		}
	} else{
		$message .= "<p>username and password are required</p>";
	}
}
include("../includes/header.php");
 ?>
 <section class="center">
	<?php if($message): ?>
	    <div class="message">
	        <?php echo $message; ?>
	    </div>
	<?php endif ?>
	<h2>Login</h2>
	<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'])?>" method="POST" class="login-form form">
		<label for="user">Email or User Name</label>
		<input type="text" id="user" name="user" value="<?php echo $user;?>">

		<label for="password">Passwords</label>
		<input type="text" id="password" name="password" value="<?php echo $pswd;?>">

		<input type="submit" name="login-btn" value="Login">
	</form> 	
 </section>
 <?php include("../includes/footer.php"); ?>