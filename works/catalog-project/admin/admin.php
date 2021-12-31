<?php 
$page_title = "admin";
$body_class = "admin";
session_start();
if (!isset($_SESSION['qwertyuiopasdfghjklZXCVBNM-2'])) {
    header("Location:login.php?from=admin");
}

require("../includes/mysql-connect.php");

if (isset($_GET)) {
	extract($_GET);
}

if ($id) {
	$get_sql = "SELECT phone_name, phone_price, phone_brand, phone_year, phone_os, phone_battery, phone_screen_size, phone_img FROM phones WHERE phone_id = $id AND u_id = ".$_SESSION['user_id'];
	$get_res = $conn->query($get_sql);
	if ($get_res->num_rows> 0) {
		$get_row = $get_res->fetch_assoc();
		extract($get_row);
	} else{
		$message = "<p>Unable to retrive information</p>";
	}
}

include("image-functions.php");
$thumb_folder = "../img/thumbnails/";
$display_folder = "../img/display/";
$original_folder = "../img/uploaded/";

if (isset($_POST['submit_btn_insert'])) {
    $image_name = $_FILES['phone_img']['name'];
    $image_type = $_FILES['phone_img']['type'];
    $image_tmp_name = $_FILES['phone_img']['tmp_name'];
    $image_error = $_FILES['phone_img']['error'];
    $image_size = $_FILES['phone_img']['size'];
    
    $phone_name = trim($_POST['phone_name']);
    $phone_price = trim($_POST['phone_price']);
    $phone_brand = trim($_POST['phone_brand']);
    $phone_year = trim($_POST['phone_year']);
    $phone_os = trim($_POST['phone_os']);
    $phone_battery = trim($_POST['phone_battery']);
    $phone_screen_size = trim($_POST['phone_screen_size']);

    $is_valid = true;

    // if ($_FILES['phone_img']['size'])
    if (is_uploaded_file($image_tmp_name)) {
        if ($image_size > 4000000) {
            $message .= "<p>image file file size too big</p>";
            $is_valid = false;
        }
        $allowed_file_types = array("image/jpeg","image/pjpeg","image/png");
        if (!in_array($image_type, $allowed_file_types)) {
            $message .= "<p>file type: $image_type is not allowed</p>";
            $is_valid = false;
        }
    } else {
    	//if editing, don't require img
    	if (!$id) {
    		$message .= "<p>image is required</p>";
        	$is_valid = false;
    	}
    }

    if (!$phone_name) {
        $message .= "<p>phone name is required</p>";
        $is_valid = false;
    } else{
        $phone_name = filter_var($phone_name, FILTER_SANITIZE_STRING);
        if ($phone_name == false) {
            $message .= "<p>please enter a phone name with no html</p>";
            $is_valid = false;
        }        
    }

    if (!$phone_price) {
        $message .= "<p>phone price is required</p>";
        $is_valid = false;
    } else{
        $phone_price = filter_var($phone_price, FILTER_VALIDATE_FLOAT);
        if ($phone_price == false) {
            $message .= "<p>please enter numbers only for price</p>";
            $is_valid = false;
        } else{
            $phone_price = filter_var($phone_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($phone_price == false) {
                $message .= "<p>please enter a valid money number</p>";
                $is_valid = false;
            } else{
                if($phone_price < 0){
                    $message .= "<p>please enter a non negative price</p>";
                    $is_valid = false;
                } else{
                    if (strlen(substr(strrchr($phone_price, "."), 1)) > 2) {
                        $message .= "<p>please make price have 2 decimal places only</p>";
                        $is_valid = false;
                    }
                }
            }
        }
    }

    if (!$phone_brand) {
        $message .= "<p>phone brand is required</p>";
        $is_valid = false;
    } else{
        $phone_brand = filter_var($phone_brand, FILTER_SANITIZE_STRING);
        if ($phone_brand == false) {
            $message .= "<p>please enter a phone name with no html</p>";
            $is_valid = false;
        }        
    }

    if (!$phone_year) {
        $message .= "<p>phone year is required</p>";
        $is_valid = false;
    } else {
        $phone_year = filter_var($phone_year, FILTER_VALIDATE_INT);
        if ($phone_year == false) {
            $message .= "<p>please enter an integer for year</p>";
            $is_valid = false;
        } else{
            $phone_year = filter_var($phone_year, FILTER_SANITIZE_NUMBER_INT);
            if ($phone_year == false) {
                $message .= "<p>please enter a valid year number, no html</p>";
                $is_valid = false;
            } else{
                if($phone_year < 1992 || $phone_year > date("Y")){
                    $message .= "<p>please enter a year from 1992 to ".date("Y")."</p>";
                    $is_valid = false;
                }
            }
        }        
    }

    if (!$phone_os) {
        $message .= "<p>phone os is required</p>";
        $is_valid = false;
    }

    if (!$phone_battery) {
        $message .= "<p>phone battery is required</p>";
        $is_valid = false;
    } else {
        $phone_battery = filter_var($phone_battery, FILTER_VALIDATE_INT);
        if ($phone_battery == false) {
            $message .= "<p>please enter an integer for battery</p>";
            $is_valid = false;
        } else{
            $phone_battery = filter_var($phone_battery, FILTER_SANITIZE_NUMBER_INT);
            if ($phone_battery == false) {
                $message .= "<p>please enter a valid battery number, no html</p>";
                $is_valid = false;
            } else{
                if($phone_battery < 0){
                    $message .= "<p>please enter a battery greater than 0</p>";
                    $is_valid = false;
                }
            }
        }        
    }

    if (!$phone_screen_size) {
        $message .= "<p>phone screen size is required</p>";
        $is_valid = false;
    } else{
        $phone_screen_size = filter_var($phone_screen_size, FILTER_VALIDATE_FLOAT);
        if ($phone_screen_size == false) {
            $message .= "<p>please enter numbers only for screen size</p>";
            $is_valid = false;
        } else{
            $phone_screen_size = filter_var($phone_screen_size, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($phone_screen_size == false) {
                $message .= "<p>please enter a valid number</p>";
                $is_valid = false;
            } else{
                if($phone_screen_size < 0){
                    $message .= "<p>please enter a non negative screen size</p>";
                    $is_valid = false;
                } else{
                    if (strlen(substr(strrchr($phone_screen_size, "."), 1)) > 1) {
                        $message .= "<p>please make screen size have 1 decimal places only</p>";
                        $is_valid = false;
                    }                
                }
            }
        }
    }

    if ($is_valid == true) {
        $upload_file = $original_folder . $image_name;

        if ($id) {
        	if (is_uploaded_file($image_tmp_name)) {
        		if (move_uploaded_file($image_tmp_name, $upload_file)) {
        			echo "<br/>img update<br/>";
		            resize_jpg_image($upload_file, $thumb_folder, 175);
		            resize_jpg_image($upload_file, $display_folder, 1000);

		            $sql = "UPDATE phones SET phone_img = '$image_name', phone_name = '$phone_name', phone_price = '$phone_price', phone_brand = '$phone_brand', phone_year = '$phone_year', phone_os = '$phone_os',  phone_battery = '$phone_battery', phone_screen_size = '$phone_screen_size' WHERE phone_id = $id";
		        } else {
		            $message .= "<p>There was a problem uploading</p>";
		        }
        	} else{
        		echo "<br/>no img update<br/>";
		        $sql = "UPDATE phones SET phone_name = '$image_name', phone_price = '$phone_price', phone_brand = '$phone_brand', phone_year = '$phone_year', phone_os = '$phone_os',  phone_battery = '$phone_battery', phone_screen_size = '$phone_screen_size' WHERE phone_id = $id";
        	}
        } else {
	        if (move_uploaded_file($image_tmp_name, $upload_file)) {
	        	echo "<br/>img insert<br/>";
	            resize_jpg_image($upload_file, $thumb_folder, 175);
	            resize_jpg_image($upload_file, $display_folder, 1000);
	            $sql = "INSERT into phones (phone_img, phone_name, phone_price, phone_brand, phone_year, phone_os, phone_battery, phone_screen_size, u_id) VALUES ('$image_name', '$phone_name', '$phone_price', '$phone_brand', '$phone_year', '$phone_os', '$phone_battery', '$phone_screen_size','".$_SESSION['user_id']."')";
	        } else {
	            $message .= "<p>There was a problem uploading</p>";
	        }    	
    	}
    	echo "$sql";
	    if ($conn->query($sql)) {
	        $phone_name = $phone_price = $phone_brand = $phone_year = $phone_os = $phone_battery = $phone_screen_size = "";
	        header("Location: ".$_SERVER['PHP_SELF']."?&m=success");
	    } else{
	        $message .= "<p>There was a problem. $conn->error</p>";
	    }
    }
}

include("../includes/header.php");
 ?>
<section class="form">
	<?php if($message): ?>
	    <div class="message">
	        <?php echo $message; ?>
	    </div>
	<?php endif ?>
	<h1><?php echo $m; ?> </h1>
	<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'])?>" method="POST" enctype="multipart/form-data" class="insert-form form">
	    <div>
	        <label for="phone_name">phone name*</label>
	        <input type="text" id="phone_name" name="phone_name" value="<?php echo $phone_name;?>">       
	    </div>
	    <div>
	        <label for="phone_img"><?php echo "image: ".$phone_img; ?></label>
	        <input type="file" id="phone_img" name="phone_img">      
	    </div>
	    <div>
	        <label for="phone_price">phone price (CAD)*</label>
	        <input type="text" id="phone_price" name="phone_price" value="<?php echo $phone_price;?>">
	    </div>
	    <div>
	        <label for="phone_brand">phone brand*</label>
	        <input type="text" id="phone_brand" name="phone_brand" value="<?php echo $phone_brand;?>">
	    </div>
	    <div>
	        <label for="phone_year">phone year*</label>
	        <input type="text" id="phone_year" name="phone_year" value="<?php echo $phone_year;?>">
	    </div>
	    <div class="radio">
	        <fieldset>
	            <legend>phone OS*</legend>
	            <div>
	                <input type="radio" name="phone_os" value="android" id="android"
	                    <?php if ($phone_os == 'android') echo "checked"; ?>>
	                <label for="android">Android</label>
	            </div>
	            <div>
	                <input type="radio" name="phone_os" value="ios" id="ios"
	                    <?php if ($phone_os == 'ios') echo "checked"; ?>>
	                <label for="ios">iOS</label>
	            </div>
	            <div>
	                <input type="radio" name="phone_os" value="other" id="other"
	                    <?php if ($phone_os == 'other') echo "checked"; ?>>
	                <label for="other">other</label>
	            </div>
	        </fieldset>
	    </div>
	    <div>
	        <label for="phone_battery">phone battery (mAh)*</label>
	        <input type="text" id="phone_battery" name="phone_battery" value="<?php echo $phone_battery;?>">
	    </div>
	    <div>
	        <label for="phone_screen_size">phone screen size (inches)*</label>
	        <input type="text" id="phone_screen_size" name="phone_screen_size" value="<?php echo $phone_screen_size;?>">
	    </div>
	    <input type="submit" name="submit_btn_insert" value="Post">
	</form>
</section>
<section class="display-section">
		<?php 
		$sql = "SELECT phone_id, phone_name, phone_price, phone_brand, phone_year, phone_os, phone_battery, phone_screen_size, phone_img, a2_users.u_id, deleted_yn FROM phones inner join a2_users on phones.u_id = a2_users.u_id WHERE deleted_yn = 'N' AND a2_users.u_id = ".$_SESSION['user_id'];

		$sql_result = $conn->query($sql); ?>

		<?php if ($sql_result->num_rows > 0): ?>
			<?php include("../includes/display-phones.php"); ?>
		<?php endif ?>
</section>
 <?php include("../includes/footer.php"); ?>