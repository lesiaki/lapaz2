<?php
ob_start();
session_start();
if(!isset($_SESSION['user_id'])){header("Location:index.php");exit();}
?>
<?php require("call.php"); ?>

<html>
	<head>
		<title>Lapaz</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/tab.css">
		<link href="css/jquery.fs.selecter.css" rel="stylesheet" type="text/css" media="all" />
		
		
	</head>

	<body>
		<div id="" class="body">
			<div id="" class="header" style="height:auto; ">
				<center>
				<h1 class="h1">LA PAZ RESORT STOCK CONTROL SYSTEM</h1>
				</center>
			</div>
			
		<div style="float:right;padding: 10px;">
			<a href="logout.php" class="myButton"><?php getUserName(); ?>|Logout</a>
		</div>
			
<div id="start" style="margin-top: 10px;">
<ul id="tabs">
    <li><a href="#" name="#tab1">Stock Control Sheet</a></li>
    <!--<li><a href="#" name="#tab2">View</a></li>-->
	<li><a href="#" name="#tab3">Manage User</a></li>
	<li><a href="#" name="#tab4">Register</a></li>
</ul>
</div>



<div id="content" style="margin-top:0px;border-top:2px solid #3D3D3D;" > 
	<!-- TAB 1 -->
	
    <?php include("includes/control_stock.php");?>
    <!-- END TAB 1 -->
    <!-- TAB 2-->
    <div id="tab2">
    <?php //include("includes/view.php"); ?>
	</div>
    <!-- TAB 3-->
    <div id="tab3">
	<?php include("includes/manage_user.php"); ?>
	</div>
    <!-- END TAB 3-->
    <!-- TAB 4-->
    <div id="tab4">
	<?php include("includes/register.php"); ?>
	</div>
    <!-- END TAB 4-->
</div>
		 <div id="" class="footer">
		 	<center><strong >&copy; 2014 Lapaz</strong></center>
		 </div> 
		</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
	<script type="text/javascript" src="js/jquery.fs.selecter.min.js"></script>
	<script type="text/javascript" src="js/selector.js"></script>
	<script>
			$(document).ready(function() {
				// All
				$("select").not(".selecter_callback").selecter();
				
				// Callback
				$("select.selecter_callback").selecter({
					callback: selectCallback
					
				});
				
				function selectCallback(value, index) {
					$(".callback_output").prepend("<p>VALUE: " + value + ", INDEX: " + index + "</p>");
					
				}
				
				// Disabled
				$(".toggle_selecter").on("click", toggleEnabled);
				if (!$(".selecter_disabled").is(":disabled")) {
					$(".toggle_selecter").text("Disable");
				} else {
					$(".toggle_selecter").text("Enable");
				}
				
				function toggleEnabled(e) {
					e.preventDefault();
					
					if ($(".selecter_disabled").is(":disabled")) {
						$(".selecter_disabled").selecter("enable");
						$(".toggle_selecter").text("Disable");
					} else {
						$(".selecter_disabled").selecter("disable");
						$(".toggle_selecter").text("Enable");
					}
				}
				
				// Disabled Option
				$(".toggle_selecter_option").on("click", toggleEnabledOption);
				if (!$(".selecter_disabled_option option").eq(0).is(":disabled")) {
					$(".toggle_selecter_option").text("Disable Option 'One'");
				} else {
					$(".toggle_selecter_option").text("Enable Option 'One'");
				}
				
				function toggleEnabledOption(e) {
					e.preventDefault();
					
					if ($(".selecter_disabled_option option").eq(0).is(":disabled")) {
						$(".selecter_disabled_option").selecter("enable", "1");
						$(".toggle_selecter_option").text("Disable Option 'One'");
					} else {
						$(".selecter_disabled_option").selecter("disable", "1");
						$(".toggle_selecter_option").text("Enable Option 'One'");
					}
				}
			});
		</script>
	</body>
</html>