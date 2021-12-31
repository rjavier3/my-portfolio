<?php 
require("includes/mysql-connect.php");

extract($_GET);

if ($phone_id) {
	$sql = "SELECT * FROM phones WHERE phone_id = $phone_id";
	$result = $conn->query($sql);
	if ($result->num_rows>0) {
		$row = $result->fetch_assoc();
		extract($row);
	}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title><?php echo $phone_name ?></title>
 </head>
<style type="text/css">
body {
	font-family: verdana, arial;
	font-size: 90%;
}
img{
	width: 100%;
}
.this-phone {
	border: 1px solid #999;
	padding: 10px;
	margin-top:10px;
	/*
	height: 150px;*/
	width: 400px;
	
}
.display-category{
	font-weight: bold;
	color: #009; 
}
.display-info{

	font-weight: normal;
	color: #900;
}
.phone-img {
	float: right;
}
.displayDescription {
	font-size: 85%;
	padding: 7px;
}
.clearFix {
	clear: both;
}
#main{
	width: 500px;
	float:left;
}
#rightcol{
	float:left;
	top: 0px;
	border: 1px solid #900;	
	width: 400px;
	padding: 7px;
}
</style>
 <body>
 	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Return home</a>
 	<div class="this-phone">
 		<img src="img/display/<?php echo $phone_img; ?>" class="phone-img" /><br/>
		<span class="display-category">Name:</span> <span class="display-info"><?php echo $phone_name; ?></span><br />
		<span class="display-category">Phone Price:</span> <span class="display-info"><?php echo $phone_brand; ?></span><br />
		<span class="display-category">phone price:</span> <span class="display-info">$<?php echo $phone_price; ?></span><br />
		<span class="display-category">phone year:</span> <span class="display-info"><?php echo $phone_year; ?></span><br />
		<span class="display-category">phone os:</span> <span class="display-info"><?php echo $phone_os; ?></span><br />
		<span class="display-category">phone battery:</span> <span class="display-info"><?php echo $phone_battery; ?>mAh</span><br />
		<span class="display-category">phone screen size:</span> <span class="display-info"><?php echo $phone_screen_size; ?>"</span><br />
 	</div>
 </body>
 </html>