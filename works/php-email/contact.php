<?php

if (!isset($_GET['event'])  && !isset($_POST['event'])) {
	header("Location:index.php");
}

if (isset($_POST['submit'])) {
	$name = trim($_POST['name']);
	$event = trim($_POST['event']);
	$email = trim($_POST['email']);
	$comments = trim($_POST['comments']);

	$is_form_valid = true;

	if ($name == "") {
		$message_name = "<p>Name is required</p>";
		$is_form_valid = false;
	} else{
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		if ($name == false) {
			$message_name .= "<p>Please enter a name with no HTML in it</p>";
			$is_form_valid = false;
		} else{
			if (strpos($name, " ") == false) {
				$message_name .= "<p>Please enter your first and last name</p>";
				$is_form_valid = false;
			}
		}
	}

	if ($email == "") {
	$message_email .= "<p>Email is required</p>";
	$is_form_valid = false;
	} else{
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ($email == false) {
			$message_email .= "<p>Please enter a email with no HTML in it.</p>";
			$is_form_valid = false;
		} else{
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			if($email == false){
				$message_email .= "<p>Please enter a valid email</p>";
				$is_form_valid = false;
			} else{
				$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
				if (preg_match($pattern, $email) == false) {
					$message_email .= "<p>Please enter a valid email</p>";
					$is_form_valid = false;
				}
			}
		}
	}

	if ($comments == "") {
	$message_comments .= "<p>message is required</p>";
	$is_form_valid = false;
	} else{
		$comments = filter_var($comments, FILTER_SANITIZE_STRING);
		if ($comments == false) {
			$message_comments .= "<p>no html allowed</p>";
			$is_form_valid = false;
		}
	}

	// Spammer part starts
	$badStrings = array("Content-Type:",
	"MIME-Version:",
	"Content-Transfer-Encoding:",
	"bcc:",
	"cc:");
	foreach($_POST as $k => $v)
	{ 
		foreach($badStrings as $v2){
			if(strpos($v, $v2) !== false)
			{
				$is_form_valid = false;
				$message .= "<p>Bad email injector.</p>";
			}
		}
	}


	$refer = $_SERVER['HTTP_REFERER'];
	$url = "https://rjavier3.dmitstudent.ca/dmit2025-a02/lab3/contact.php";
	if ($refer != $url && $refer != "$url?event=may27" && $refer != "$url?event=may28" && $refer != "$url?event=may29" && $refer != "$url?event=may30") {
		$is_form_valid = false;
		$message .= "<p>this info was not sent from our form. it will not be processed.</p>";
	}

	$ip = $_SERVER['REMOTE_ADDR'];
	$spams = array (
		"static.16.86.46.78.clients.your-server.de", 
		"87.101.244.8", 
		"144.229.34.5", 
		"89.248.168.70",
		"reserve.cableplus.com.cn",
		"94.102.60.182",
		"194.8.75.145",
		"194.8.75.50",
		"194.8.75.62",
		"194.170.32.252"
	);

	foreach ($spams as $site) 
	{
		$pattern = "/$site/i";
		if (preg_match ($pattern, $ip)) 
		{
			$is_form_valid = false;
			$message .= "<p>Bad spammer</p>"	;		   
		}
	}
	//spammer part ends

	if ($is_form_valid == true) {
		switch ($event) {
			case 'may27':
				$event_name = "May 27 - Remembering the First World War";
				break;
			case 'may28':
				$event_name = "May 28 - I Am Here";
				break;
			case 'may29':
				$event_name = "May 29 - Vikings Beyond the Legend";
				break;
			case 'may30':
				$event_name = "May 30 - Late Night at RAM";
				break;
			default:
				$event_name = $event;
				break;
		}

		$to = "saaafe.spam@gmail.com";
		$subject = "Web Form Submission";

		$content = "<h2>From the DMIT2025-a02 lab3</h2>";
		$content .= "<p>Name: $name</p>";
		$content .= "<p>email: $email</p>";
		$content .= "<p>event: $event_name</p>";
		$content .= "<p>message: $comments</p>";

		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";

		$headers .= "From: DMITstudent <info@dmitstudent.ca>\n";

		mail($to, $subject, $content, $headers);

		header("Location:confirmation.php");
	}
}

 include("includes/header.php"); ?>
			<!-- main.container starts -->
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
				<div class="error">
					<?php if ($message){
						echo "<p>$message</p>";
					}
					 ?>
				</div>

				<label for="name">Your Name</label>
				<input type="text" id="name" name="name" value="<?php echo $name; ?>">
				<div class="error">
					<?php if ($message_name){
						echo "<p>$message_name</p>";
					}
					 ?>
				</div>

				<label for="event">Event</label>
				<select name="event" id="event">
				  <option value="may27" 
				  	<?php 
				  		if ($_GET['event'] == 'may27' || $_POST['event'] == 'may27') { 
				  			echo "selected=\"true\";";
				  		} 
				  	?>
				  	>Remembering the First World War - May 27</option>
				  <option value="may28" 
				  	<?php 
				  		if ($_GET['event'] == 'may28' || $_POST['event'] == 'may28') { 
				  			echo "selected=\"true\";";
				  		} 
				  	?>
				  	>I Am Here - May 28</option>
				  <option value="may29" 
				  	<?php 
				  		if ($_GET['event'] == 'may29' || $_POST['event'] == 'may29') { 
				  			echo "selected=\"true\";";
				  		} 
				  	?>
				  >Vikings Beyond the Legend - May 29</option>
				  <option value="may30"
				  	<?php 
				  		if ($_GET['event'] == 'may30' || $_POST['event'] == 'may30') { 
				  			echo "selected=\"true\";";
				  		} 
				  	?>
				   >Late Night at RAM - May 30</option>
				</select>
				<div class="error">
					
				</div>

				<label for="email">Email</label>
				<input type="text" id="email" name="email" value="<?php echo $email; ?>">
				<div class="error">
					<?php if ($message_email){
						echo "<p>$message_email</p>";
					}
					 ?>
				</div>


				<label for="comments">Message</label>
				<textarea name="comments" id="comments"><?php echo $comments; ?></textarea>
				<div class="error">
					<?php if ($message_comments){
						echo "<p>$message_comments</p>";
					}
					 ?>
				</div>

				<input type="submit" name="submit" value="Send me email">


			</form>
			<!-- main.container ends -->
<?php include("includes/footer.php"); ?>