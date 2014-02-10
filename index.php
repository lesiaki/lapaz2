<?php
ob_start();
session_start();
require_once ("connection/conn.php");
include ("functions/userFunction.php");
?>
<html>
	<head>
		<title>Lapaz</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div id="" class="body">
			<div id="" class="header">
				<center>
				<h1 class="h1">LA PAZ RESORT STOCK CONTROL SYSTEM</h1>
				</center>
			</div>
			<div id="" class="login_box">
				<form action="" method="post">
					<p>
						<input class="input" type="text" name="username" placeholder="Username">
					</p>
					<p>
						<input class="input" type="password" name="password" placeholder="Password">
					</p>
					<p>
						<input class="myButton" type="submit" value="Login" name="sub">
					</p>
				</form>
				<p class="error" id="">
					<?php 
					if(isset($_POST['username'], $_POST['password'])){
					login($_POST['username'], $_POST['password']);	
					}
					
					 ?>
				</p>
			</div>
		<div id="">
			<hr class="hr"/>
			<center><strong >&copy; 2014 Lapaz</strong></center>
		</div>	
		</div>
		

	</body>
</html>