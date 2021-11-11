<?php

$the_page = basename($_SERVER['PHP_SELF']);

switch ($the_page) {
	case 'insert.php':
		$page_title = "Insert";
		$css_link = "../css/style.css";
		break;
	case 'login.php':
		$page_title = "Login";
		$css_link = "../css/style.css";
		break;
	default:
		$page_title = "";
		$css_link = "css/style.css";
		break;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php  echo "$page_title"; ?></title>
	<link rel="stylesheet" href="<?php echo $css_link; ?>">
</head>
<body>
	<div class="container">	
		<header>
			<section class="title-bar">
				<h1>Pet Fun Run</h1>
				<p><?php echo $page_title; ?></p>
			</section>
			<nav>
				<ul>
					<li><a href="/dmit2025-a02/lab2/index.php">Public</a></li>
					<li><a href="/dmit2025-a02/lab2/admin/insert.php">Insert</a></li>
				</ul>
			</nav>		
		</header>