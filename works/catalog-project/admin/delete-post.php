<?php 
session_start();
require("../includes/mysql-connect.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];

	if (!isset($_SESSION['qwertyuiopasdfghjklZXCVBNM-2'])) {
	    header("Location:login.php?from=admin");
	} else{
		$sql ="SELECT u_id FROM phones WHERE phone_id = $id AND u_id = ".$_SESSION['user_id'];
		$res = $conn->query($sql);
		if ($res->num_rows>0) {
			$update_sql = "UPDATE phones set deleted_yn = 'Y' WHERE phone_id = $id 
			";
			if ($conn->query($update_sql)) {
				header("Location: ".$_SERVER['HTTP_REFERER']."?m=addeleted");
			} else{
				$string = $conn->error;
				header("Location: ".$_SERVER['HTTP_REFERER']."?m=$string");
			}
		} else{
			header("Location: ".$_SERVER['HTTP_REFERER']."?m=notrightuser");
		}
	}
}

 ?>