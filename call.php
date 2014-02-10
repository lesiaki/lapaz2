<?php 

require_once ("connection/conn.php");
include ("functions/userFunction.php");
include ("functions/stockFunction.php");

?>
<?php 
if(isset($_POST['cat_id'])){
	$cat_id = $_POST['cat_id'];
	getDrinks($cat_id);
}
if(isset($_POST['cat_id_for_register'])){
	
	$cat_id = $_POST['cat_id_for_register'];
	getRegisteredDrinks($cat_id);
}

if(isset($_POST['drink_input'],$_POST['cat_selected'],$_POST['buy_price'],$_POST['selling_price'])){
	$drink_input = $_POST['drink_input'];
	$cat_selected = $_POST['cat_selected'];
	$buy_price = $_POST['buy_price'];
	$selling_price = $_POST['selling_price'];
	
	insertDrink($cat_selected,$drink_input,$buy_price,$selling_price);
	
}
if(isset($_POST['input_cat'])){
	$input_cat = $_POST['input_cat'];
	insertCategory($input_cat);
}
if(isset($_POST['delete_cat_id'])){
	$delete_cat_id = $_POST['delete_cat_id'];
	deleteCategoryFromTable($delete_cat_id);
}

if(isset($_POST['delete_drink_id'],$_POST['cat_id_For_dlt'])){
	$delete_drink_id = $_POST['delete_drink_id'];
	$cat_id = $_POST['cat_id_For_dlt'];
	deleteDrinkFromTable($delete_drink_id,$cat_id);
}
if(isset($_POST['updateSelection'])){
	 getCat();
}

if(isset($_POST['displayRecordsView'])){
	$tarehe = $_POST['displayRecordsView'];
	getRecords($tarehe);
}

if(isset($_POST['user'],$_POST['pass'],$_POST['status'])){
		$user = $_POST['user'];	
		$pass = $_POST['pass'];	
		$status = $_POST['status'];	
		
		addNewUser($user,$pass,$status);
}
if(isset($_POST['deleteUserID'])){
	$deleteUserID = $_POST['deleteUserID'];
	deleteUserFromTable($deleteUserID);
}
if(isset($_POST['current_pass'],$_POST['new_pass'])){
	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass'];
	changePassword($current_pass,$new_pass);
}
if(isset($_POST['specificStockDrink'],$_POST['caT_id'])){
	$drink_id=$_POST['specificStockDrink'];
	$caT_id = $_POST['caT_id'];
	viewSpecificStock($drink_id,$caT_id);
}
if(isset($_POST['date_from'],$_POST['date_to'],$_POST['drink_id'])){
	
	echo calGenerealTrendy($_POST['drink_id'],$_POST['date_from'],$_POST['date_to']);
}

if(isset($_POST['checked_date'])){
	checkDateExistence($_POST['checked_date']);
}
if(isset($_POST['sid'],$_POST['did'],$_POST['cat'])){
	deleteStock($_POST['sid'],$_POST['did'],$_POST['cat']);
}

if(isset($_POST['nothing'])){
	//This is some test here
}




?>
