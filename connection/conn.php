<?php 
//Start Session
session_start();
//

?>
<?php
//include constant file
require_once("constant.php");
//connection with server
$server = mysql_connect(SERVER,DBUSR,DBPASS);
if($server){
	//connected
	$db = mysql_select_db(DB,$server);
	if($db){}else{
		header("Location:connection/server.php?e=db");
		exit();
	}
}else{ 
	//Not connected
	header("Location:connection/server.php?e=server");
	exit();
}
?>