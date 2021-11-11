<?php 
session_start();

if (!isset($_SESSION['n0j4gl3ds10or8jvcoqbba6smu-russell'])) {
	header("Location:login.php");
}


if (isset($_POST['register'])) {
	$owner_name = $_POST['owner_name'];
	$phone = $_POST['phone'];
	$pet_name = $_POST['pet_name'];
	$pet_type = $_POST['pet_type'];

	if ($owner_name && $phone && $pet_name && $pet_type) {
		save_registration($owner_name, $phone, $pet_name, $pet_type);
		$message = "You added, congrats";
	} else{
		$message = "Please fill in all the fields";
	}

}

function save_registration($name_of_owner, $phone_of_owner, $pet_name, $pet_type){
	// $timedate = date("l, M d, Y @ g:i a");
	$postdate = date("M d, Y");
	$posttime = date("g:ia l");

	//step1
	$file = fopen("registrants.txt", "r");
	if($file){
		while(!feof($file)){
			$buffer = fgets($file, 4096);
			$old_stuff .= $buffer;
		}
		fclose($file);
	}

	switch ($pet_type) {
		case 'dog':
			$img_src = "img/dog-min.png";
			break;
		case 'cat':
			$img_src = "img/cat-min.png";
			break;
		case 'bird':
			$img_src = "img/bird-min.png";
			break;
		case 'fish':
			$img_src = "img/fish-min.png";
			break;	
		default:
			$img_src = "img/other-min.png";
			break;
	}

	//step2
	$new_stuff = "<div class=\"registrant\">\n";
	$new_stuff .= "\t<div class=\"owner\">\n";
	$new_stuff .= "\t\t<div class=\"owner-detail\">\n";
	$new_stuff .= "\t\t\t<h2>$name_of_owner</h2>\n";
	$new_stuff .= "\t\t\t<p>$phone_of_owner</p>\n";
	$new_stuff .= "\t\t</div>\n";
	$new_stuff .= "\t\t<div class=\"date\">\n";
	$new_stuff .= "\t\t\t<p>$postdate</p>\n";
	$new_stuff .= "\t\t\t<p>$posttime</p>\n";
	$new_stuff .= "\t\t</div>\n";
	$new_stuff .= "\t</div>\n";
	$new_stuff .= "\t<div class=\"pet\">\n";
	$new_stuff .= "\t\t<p>$pet_name | $pet_type</p>\n";
	$new_stuff .= "\t\t<div class=\"pet-img\">\n";
	$new_stuff .= "\t\t\t<img src=\"$img_src\" alt=\"pet\">\n";
	$new_stuff .= "\t\t</div>\n";
	$new_stuff .= "\t</div>\n";
	$new_stuff .= "</div>\n";

	$file = fopen("registrants.txt", "w");

	//step3
	$all_stuff = $new_stuff . $old_stuff;

	//step4
	fwrite($file, $all_stuff);
	fclose($file);
}

include("../includes/header.php");
 ?>
<main>
	<section>
		 <form action="" method="POST">
	 	<label for="owner_name">Owner Name</label>
	 	<input type="text" id="owner_name" name="owner_name">

	 	<label for="phone">Phone</label>
	 	<input type="tel" id="phone" name="phone">

	 	<label for="pet_name">Pet Name</label>
	 	<input type="text" name="pet_name" id="pet_name">

	 	<label for="pet_type">Pet Type</label>
	 	<select name="pet_type" id="pet_type">
	 		<option value="">Select Animal</option>
	 		<option value="dog">Dog</option>
	 		<option value="cat">Cat</option>
	 		<option value="bird">Bird</option>
	 		<option value="fish">Fish</option>
	 		<option value="other">Other</option>
	 	</select>

	 	<input type="submit" value="Register" name="register">
	 	
		 <?php 
			if ($message) {
				echo "<p class=\"message\">$message</p>";
			}
		 ?>
	 </form>
	</section>
</main>
<?php include("../includes/footer.php"); ?>