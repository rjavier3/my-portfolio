<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body class="<?php echo $body_class;?>">
	<div class="container">
		<header>
			<div class="logo">
				<a href="<?php echo BASE_URL; ?>"><div></div></a>
			</div>
			<nav class="hidden">
				<ul>
					<li><a href="<?php echo BASE_URL;?>">Home</a></li>
					<li><a href="<?php echo BASE_URL;?>display.php">Catalogue</a></li>
					<?php if ($_SESSION['first_name']): ?>
						<li><a href="<?php echo BASE_URL; ?>admin/admin.php">Admin</a></li>
						<li><a href="<?php echo BASE_URL; ?>admin/logout.php">Logout</a></li>
					<?php else: ?>
						<li><a href="<?php echo BASE_URL; ?>admin/login.php">Login</a></li>
					<?php endif ?>
				</ul>
			</nav>
			<div class="menu-icons-container">
                <div class="menu-icon burger">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <path d="M2 6h28v6h-28zM2 14h28v6h-28zM2 22h28v6h-28z"></path>
                    </svg>
                </div>
                <div class="menu-icon x hidden-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <path d="M30 24.398l-8.406-8.398 8.406-8.398-5.602-5.602-8.398 8.402-8.402-8.402-5.598 5.602 8.398 8.398-8.398 8.398 5.598 5.602 8.402-8.402 8.398 8.402z"></path>
                    </svg>                    
                </div>
            </div>
		</header>
		<main>