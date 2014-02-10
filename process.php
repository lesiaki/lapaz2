<?php
require_once ("connection/conn.php");
include ("functions/userFunction.php");
include ("functions/stockFunction.php");
?>

<?php
//Check if variable have anything
if (isset($_POST['muuzaji'], $_POST['siku'], $_POST['date'])) {
	//Select
	$selected_cat = $_POST['selecter_basic'];
	//Assing Known variable
	$muuzaji = $_POST['muuzaji'];
	$siku = $_POST['siku'];
	$tarehe = $_POST['date'];
	//Create array for store some errors
	$errors = array();
	if ($muuzaji == "" || $siku == "" || $tarehe == "") {
		$errors[] = "All input must be filled";
	}
	if(checkDateExistence($tarehe,$selected_cat)){
		header("Location:manage.php?f=You must change date, ".getCategoryWithId($selected_cat)." records already exist for this date $tarehe");
		exit();
	}
	//Assign total counter to initialize the loop
	$total_counter = $_POST['total_counter'];
	//Checking empty input for stock and counter
	$stock_err=false;
	for ($i = 1; $i <= $total_counter; $i++) {
		//Checkfor empty
		if ($_POST["open_stock_store_$i"] == "" || $_POST["new_stock_$i"] == "" || $_POST["issued_counter_$i"] == "" || $_POST["closing_balance_store_$i"] == "" || $_POST["opening_counter_$i"] == "" || $_POST["received_from_store_$i"] == ""  || $_POST["store_$i"] == "" || $_POST["closing_stock_counter_$i"] == "") {
			$stock_err = true;
			}
		if (!isset($_POST["open_stock_store_$i"],$_POST["new_stock_$i"],$_POST["issued_counter_$i"],$_POST["closing_balance_store_$i"],$_POST["opening_counter_$i"],$_POST["received_from_store_$i"],$_POST["store_$i"],$_POST["closing_stock_counter_$i"])) {
			$stock_err = true;
			}
		/* For debbugin
		echo '1.open_stock_store = '.$_POST["open_stock_store_$i"].'<br />';
		echo '2.new_stock ='.$_POST["new_stock_$i"].'<br />';
		echo '3.issued_counter = '.$_POST["issued_counter_$i"].'<br />';
		echo '4.closing_balance_store = '.$_POST["closing_balance_store_$i"].'<br />';
		echo '5.opening_counter = '.$_POST["opening_counter_$i"].'<br />';
		echo '6.received_from_store = '.$_POST["received_from_store_$i"].'<br />';
		echo '7.store = '.$_POST["store_$i"].'<br />';
		echo '8.closing_stock_counter = '.$_POST["closing_stock_counter_$i"].'<br />';
		echo '<hr />';
		End Debuggin */
	}
	if($stock_err){$errors[] = " including the stock filled";}
	
	//Checking for any errors
	if (!empty($errors)) {
		
		foreach ($errors as $error) {
			//echo $error;
		}
	//Redirect with error
	header("Location:manage.php?f=All input must be filled");exit();
	
	} else {
		//Every thing is okay no errors 1. insert into muuzaji table
		$muuzaji = mysql_real_escape_string(htmlentities($muuzaji));
		$siku = mysql_real_escape_string(htmlentities($siku));
		$tarehe = mysql_real_escape_string(htmlentities($tarehe));

		$query = mysql_query("INSERT INTO muuzaji VALUES('','$muuzaji','$siku','$tarehe')");
		if ($query) {
			
			//Last inserted muuzaji_id
			$muuzaji_id = mysql_insert_id();
			//Insert into stock table
			for ($i = 1; $i <= $total_counter; $i++) {
				//echo $total_counter;
				//Store the drink id every time we loop
				$drink_id = $_POST["drink_id_$i"];

				//validation
				$open_stock_store = mysql_real_escape_string(htmlentities($_POST["open_stock_store_$i"]));
				$new_stock = mysql_real_escape_string(htmlentities($_POST["new_stock_$i"]));
				$issued_counter = mysql_real_escape_string(htmlentities($_POST["issued_counter_$i"]));
				$closing_balance_store = mysql_real_escape_string(htmlentities($_POST["closing_balance_store_$i"]));
				$opening_counter = mysql_real_escape_string(htmlentities($_POST["opening_counter_$i"]));
				$received_from_store = mysql_real_escape_string(htmlentities($_POST["received_from_store_$i"]));
				$store = mysql_real_escape_string(htmlentities($_POST["store_$i"]));
				$closing_stock_counter = mysql_real_escape_string(htmlentities($_POST["closing_stock_counter_$i"]));

				//Insert
				$queryLast = mysql_query("INSERT INTO stock VALUES('','$drink_id','$selected_cat','$muuzaji_id','$open_stock_store','$new_stock','$issued_counter','$closing_balance_store','$opening_counter','$received_from_store','$store','$closing_stock_counter')");
					
			}
			
		} else {
			//Else for Code Block Query for Muuzaji
			echo "Muuzaji table anazingua";
		}

	}
	//Come with succes
	if($queryLast){
					header("Location:manage.php?f=Succeful Saved");exit();
				}

}
?>