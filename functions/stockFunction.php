<?php 
		
function getCat(){
	$query = mysql_query("SELECT * FROM category");
	if($query){
		While($row = mysql_fetch_array($query)){
			?>
			<option name="" id="" value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']?></option>
			<?php
			}
			}
			}

			function getDrinks($cat_id){
			$query = mysql_query("SELECT * FROM drinks WHERE cat_id = '$cat_id'");
			if($query){

			if(mysql_num_rows($query) == 0){
		?>
		<p class="error">No any Drinks Register</p>
		<?php
		}else{
			?>
			<table border="0px" width="100%">
			<tr class="tr1">
			<td>S/n</td>
			<td>Description</td>
			<td>View</td>
			<td>Open Stock Store</td>
			<td>New Stock</td>
			<td><span class="tdc">Issued Counter</span></td>
			<td>Closing Balance Store</td>
			<td>Opening Counter</td>
			<td>Received From Store</td>
			<td><span class="tdc">Sold</span></td>
			<td>Closing Stock Counter</td>
			<td><span class="tds">Sales Tsh</span></td>
			
		</tr>
		<?php
		//Counter
		$counter = 1;
		$total_counter = mysql_num_rows($query);
		?>
		<input  type="hidden" value="<?php echo $total_counter; ?>" name="total_counter" />
		<?php
		while($row = mysql_fetch_array($query)){
			//Create varibale name for input
			
			$id = $row['drink_id'];
			$drink_id = 'drink_id_'.$counter;
			$open_stock_store = 'open_stock_store_'.$counter;
			$new_stock ='new_stock_'.$counter;
			$issued_counter = 'issued_counter_'.$counter;
			$closing_balance_store = 'closing_balance_store_'.$counter;
			$opening_counter='opening_counter_'.$counter;
			$received_from_store='received_from_store_'.$counter;
			$store = 'store_'.$counter;
			$closing_stock_counter = 'closing_stock_counter_'.$counter;
			
			?>
			<tr onmouseover="setCursor(this);">
				
				<td><?php echo $counter; ?>.</td>
<td><?php echo $row['drink_name']; ?>
	<input type="hidden" name="<?php echo $drink_id; ?>" value="<?php echo $id; ?>"/>
	<input type="hidden" value="<?php echo getSellingPrice($id); ?>" id='selling_price' />
	</td>
<td id="view_logo">
	<a href="javascript:void(0);" title="View" onclick="viewStockDrink(<?php echo $id;?>);"><img src="images/play.png"/></a>
	</td>
				<td><input id="1in" type="text" onkeyup="cal1(this);" value="<?php getStockValue($id,'closing_balance_store');?>" name="<?php echo $open_stock_store; ?>"  id="" class="input 1in" style="width:100px;"></td>
				<td><input id="2in" type="text" onkeyup="cal2(this);" value="<?php //getStockValue($id,'new_stock');?>" name="<?php echo $new_stock; ?>" id="" class="input 2in" style="width:100px;"></td>
				<td><input id="3in" type="text" value="<?php //getStockValue($id,'issued_counter');?>" name="<?php echo $issued_counter; ?>" id="" class="input 3in" style="width:100px;"></td>
				<td><input id="4in" type="text" onkeyup="cal4(this);" value="<?php //getStockValue($id,'closing_balance_store');?>" name="<?php echo $closing_balance_store; ?>" id="" class="input 4in" style="width:100px;"></td>
				<td><input id="5in" type="text" onkeyup="cal5(this);" value="<?php getStockValue($id,'closing_stock_counter');?>" name="<?php echo $opening_counter; ?>" id="" class="input 5in" style="width:100px;"></td>
				<td><input id="6in" type="text" value="<?php //getStockValue($id,'received_from_store');?>" name="<?php echo $received_from_store; ?>" id="" class="input 6in" style="width:100px;"></td>
				<td><input id="7in" type="text" value="<?php //getStockValue($id,'sold');?>" name="<?php echo $store; ?>" id="" class="input 7in" style="width:100px;"></td>
				<td><input id="8in" type="text" onkeyup="cal8(this);" value="<?php //getStockValue($id,'closing_stock_counter');?>" name="<?php echo $closing_stock_counter; ?>" id="" class="input 8in" style="width:100px;"></td>
				<td>
					<span id="sells_value"></span>
				</td>
				
			</tr>
			<?php
			//Update counter
			$counter++;
			}
		?>
		</table>
			<?php
			}
		?>
		
		<?php
		}

		}

		function getRegisteredDrinks($cat_id){

		$query = mysql_query("SELECT * FROM drinks WHERE cat_id = '$cat_id'");
		if($query){
		if(mysql_num_rows($query) == 0){
			?>
			<p class="error">No any Drink Registered</p>
			<?php
			}else{
				?>
				<tr class="tr1">
					<td>S/n</td>
					<td>Drinks</td>
					<td>Buy Price</td>
					<td>Selling Price</td>
					<?php if(getStatus($_SESSION['user_id'])){
						?>
						<td>Delete</td>
						<?php
					}?>
					
				</tr>
				<?php
			$sn = 1;
			while($row=mysql_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $sn; ?>.</td>
					<td><?php echo $row['drink_name']; ?>&nbsp;</td>
					<td><?php echo $row['buy_price']; ?>&nbsp;</td>
					<td><?php echo $row['selling_price']; ?>&nbsp;</td>
					<?php if(getStatus($_SESSION['user_id'])){
						?>
						<td id="dlt_logo">
						<a title="Delete" href="javascript:void(0);" onclick="javascript:deleteDrink(<?php echo $row['drink_id']?>);" >
							<img src="images/drop.png">
						</a>
					</td>
						<?php
					}?>
					
				</tr>
				<?php
				$sn++;
				}
				}

				}
				}

				function getRegisteredCategory(){
				$query = mysql_query("SELECT * FROM category");
				if($query){
				if(mysql_num_rows($query) == 0){
			?>
			<p class="error">No any Category Registered</p>
			<?php
			}else{
				?>
				<tr class="tr1">
				<td>S/n</td>
				<td>Category Registered</td>
				<td>Delete</td>
			</tr>
				<?php
			$sn = 1;
			while($row=mysql_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $sn; ?>.</td>
					<td><?php echo $row['cat_name']; ?>&nbsp;</td>
					<?php 
					if(getStatus($_SESSION['user_id'])){
						?>
						<td id="dlt_logo">
						<a title="Delete" href="javascript:void(0);" onclick="javascript:deleteCategory(<?php echo $row['cat_id']; ?>);" >
							<img src="images/drop.png">
						</a>
					</td>
						<?php
					}
					?>
					
				</tr>
				<?php
				$sn++;
				}
				}

				}
				}

				function insertDrink($cat_selected,$drink_input,$buy_price,$selling_price){
				$drink_input = mysql_real_escape_string(htmlentities($drink_input));
				$buy_price = mysql_real_escape_string(htmlentities($buy_price));
				$selling_price = mysql_real_escape_string(htmlentities($selling_price));
				
				$query = mysql_query("INSERT INTO drinks VALUES('','$cat_selected','$drink_input','$buy_price','$selling_price')");
				if($query){
				getRegisteredDrinks($cat_selected);
				}
				}
				function insertCategory($input_cat){
				$input_cat = mysql_real_escape_string(htmlentities($input_cat));
				$query = mysql_query("INSERT INTO category VALUES('','$input_cat')");
				if($query){
				getRegisteredCategory();
				}
				}
				function deleteCategoryFromTable($delete_cat_id){
				$query = mysql_query("DELETE FROM category WHERE cat_id = '$delete_cat_id'");
				if($query){
				if(deleteDrinkCorespondingWithCategory($delete_cat_id)){
				getRegisteredCategory();
				}

				}
				}
				function deleteDrinkCorespondingWithCategory($cat_id){
				$query = mysql_query("DELETE FROM drinks WHERE cat_id = '$cat_id'");
				if($query){return true;}else{return false;}
				}
				function deleteDrinkFromTable($delete_drink_id,$cat_id){
				$query = mysql_query("DELETE FROM drinks WHERE drink_id = '$delete_drink_id' ");
				if($query){
				getRegisteredDrinks($cat_id);
				}
				}
				function deleteMuuzaji($muuzaji_id){
				$query = mysql_query("DELETE FROM muuzaji WHERE muuzaji_id = '$muuzaji_id'");
				if($query){return true;}else{return false;}
				}
				
				
				
				function getRecords($tarehe){
				$query = mysql_query("SELECT * FROM muuzaji,stock WHERE muuzaji.muuzaji_id = stock.muuzaji_id AND muuzaji.date= '$tarehe'");
				$q = mysql_query("SELECT * FROM muuzaji,stock WHERE muuzaji.muuzaji_id = stock.muuzaji_id AND muuzaji.date= '$tarehe'");
				
				if($query && $q){
				if(mysql_num_rows($query) == 0){
					?>
					<p class="error">No any Result found</p>
					<?php
				}else{
					$counter=1;
				?>
				<hr class="hr" />
				<table class="" width="500px;">
					<tr>
						<td>Muuzaji:&nbsp;<b style="color:#2AC7E1"><?php echo mysql_result($q,0,1); ?></b></td>
						<td>Siku:&nbsp;<b style="color:#2AC7E1"><?php echo mysql_result($q,0,2); ?></b></td>
						<td>Tarehe:&nbsp;<b style="color:#2AC7E1"><?php echo mysql_result($q,0,3); ?></b></td>
					</tr>
				</table>
				<hr  class="hr" />
			<table>
							<tr class="tr1">
			<td>S/n</td>
			<td>Description</td>
			<td></td>
			<td>Open Stock Store</td>
			<td>New Stock</td>
			<td>Issued Counter</td>
			<td>Closing Balance Store</td>
			<td>Opening Counter</td>
			<td>Received From Store</td>
			<td>Sold</td>
			<td>Closing Stock Counter</td>
			<td>Sales Tsh</td>
			
		</tr>
			<?php
					while($row=mysql_fetch_array($query)){
						
						?>
						
							<tr>
								<td><?php echo $counter; ?></td>
								<td><?php echo getDrinkName($row['drink_id']); ?></td>
								<td><?php echo $row['open_stock_store'];?></td>
								<td><?php echo $row['new_stock'];?></td>
								<td><?php echo $row['issued_counter']; ?></td>
								<td><?php echo $row['closing_balance_store'];?></td>
								<td><?php echo $row['open_counter'];?></td>
								<td><?php echo $row['received_from_store'];?></td>
								<td><?php echo $row['sold'];?></td>
								<td><?php echo $row['closing_stock_counter'];?></td>
								<td><?php //echo getSales($drink_id,15); ?></td>
							</tr>
						
						<?php
						$counter++;
						}
				?>
				</table>
				<?php

				}

				}
				}

function getDrinkName($drink_id){
	$query = mysql_query("SELECT drink_name FROM drinks WHERE drink_id= '$drink_id'");
	if($query){
		return mysql_result($query,0,0);
	}
}

function getStockValue($drink_id,$column_name){
	$query = mysql_query("SELECT $column_name FROM stock WHERE drink_id = '$drink_id' ORDER BY stock_id DESC LIMIT 1");
	if($query){
		echo mysql_result($query,0,0);
	}
}
 
function viewSpecificStock($drink_id,$caT_id){
	$query = mysql_query("SELECT * FROM stock WHERE drink_id = '$drink_id'");
	if($query){
		?>
		<a href="javascript:void(0);" onclick="javascript:getDrinksJQ(<?php echo $caT_id;?>);">
				
			<table class="browser-support-table">
				<tr>
					<td><img src="images/arrow-l.png"></td>
					<td  class="clr"><?php echo getDrinkName($drink_id); ?></td>
				</tr>
				
			</table>
			</a>
		<?php
		
		if(mysql_num_rows($query) == 0){
			
			?>
			<p class="error" style="padding-left:30px;">No data found</p>
			<?php
		
			}
			else{
			$counter=1;
			
			?>
			<table>
				<tr class="tr1">
			<td>S/n</td>
			<td>Date</td>
			<td>Seller</td>
			<td>Day</td>
			<td>Delete All</td>
			<td>Open Stock Store</td>
			<td>New Stock</td>
			<td><span class="tdc">Issued Counter</span></td>
			<td>Closing Balance Store</td>
			<td>Opening Counter</td>
			<td>Received From Store</td>
			<td><span class="tdc">Sold</span></td>
			<td>Closing Stock Counter</td>
			<td><span class="tds">Sales (Tsh)</span></td>
			<td><span class="tdp">Profit/Loss (Tsh)</span></td>
		</tr>
			<?php
			while($row = mysql_fetch_array($query)){
				//Create varibale name for input
			
			$id = $row['drink_id'];
			$stock_id = $row['stock_id'];
			$drink_id = 'drink_id_'.$counter;
			$open_stock_store = 'open_stock_store_'.$counter;
			$new_stock ='new_stock_'.$counter;
			$issued_counter = 'issued_counter_'.$counter;
			$closing_balance_store = 'closing_balance_store_'.$counter;
			$opening_counter='opening_counter_'.$counter;
			$received_from_store='received_from_store_'.$counter;
			$store = 'store_'.$counter;
			$closing_stock_counter = 'closing_stock_counter_'.$counter;
				?>
				<tr>
				
				<td><?php echo $counter; ?>.</td>
				<td><?php getTarehe($row['muuzaji_id']);?>
	<input type="hidden" name="<?php echo $drink_id; ?>" value="<?php echo $id; ?>"/></td>
				<td><?php echo getMuuzajiName($row['muuzaji_id']);?></td>
				<td><?php echo getSikuYaMuuza($row['muuzaji_id']);?></td>
				<td id="dlt_logo">
					<a title="Delete" href="javascript:void(0);" onclick="javascript:dltRow(<?php echo $stock_id; ?>,<?php echo $id; ?>);">
					<img src="images/drop.png" width="16px"/>
					</a>
				</td>
				<td><?php echo $row['open_stock_store'];?></td>
				<td><?php echo $row['new_stock'];?></td>
				<td><?php echo $row['issued_counter'];?></td>
				<td><?php echo $row['closing_balance_store'];?></td>
				<td><?php echo $row['open_counter'];?></td>
				<td><?php echo $row['received_from_store'];?></td>
				<td><?php echo $row['sold'];?></td>
				<td><?php echo $row['closing_stock_counter'];?></td>
				<td><?php echo currency_format(getSales($id,$row['stock_id'])); ?></td>
				<td><?php echo getProfit($id,$row['stock_id']); ?></td>
			</tr>
				<?php
				$counter++;
			}
			?>
			</table>
			<hr class="hr">
			<p class="alert" style="padding-left: 10px;">Findout your business trend by provide dates range starting from your beggin to your end point.</p>
			<table>
				<tr>
					<td >
						<select id="date_from">
						<option value="date_from">Date From</option>
						<?php getDates($id); ?>
						</select>
					
					</td>
					<td>
						<select id="date_to">
						<option value="date_to">Date to</option>
						<?php getDates($id); ?>
					</select>
					</td>
					<td><input type="button" class="myButton" value="View Sells Trend" name="" onclick="trendy(<?php echo $id; ?>)"/></td>
				</tr>
			</table>
			<p id="showTrendy"><p>
			<?php
		}
	}
} 
 
function getTarehe($muuzaji_id){
	$query = mysql_query("SELECT date FROM muuzaji WHERE muuzaji_id = '$muuzaji_id'");
	if($query){
		echo mysql_result($query,0,0);
	}
	
} 
function getMuuzajiName($muuzaji_id){
	$query = mysql_query("SELECT muuzaji FROM muuzaji WHERE muuzaji_id = '$muuzaji_id'");
	if($query){
		echo mysql_result($query,0,0);
	}
	
} 
function getSikuYaMuuza($muuzaji_id){
	$query = mysql_query("SELECT siku FROM muuzaji WHERE muuzaji_id = '$muuzaji_id'");
	if($query){
		echo mysql_result($query,0,0);
	}
	
} 
//fxn to calculate issued counter
function calculateIssuedCounter($open_stock_store,$new_stock,$closing_balance_store){
	$issued_counter = ($open_stock_store+$new_stock)-$closing_balance_store;
	return $issued_counter;
}
//Calculate sales

function getSales($drink_id,$stock_id){
		$sells = getSold($stock_id)*getSellingPrice($drink_id);
		return $sells;
}
function getProfit($drink_id,$stock_id){
		$bought = getSold($stock_id)*getBuyingPrice($drink_id);
		return getSales($drink_id,$stock_id)-$bought;
}
function getBuyingPrice($drink_id){
	$query = mysql_query("SELECT buy_price FROM drinks WHERE drink_id ='$drink_id'");
	if($query){return mysql_result($query,0,0);}	
}
function getSellingPrice($drink_id){
	$query = mysql_query("SELECT selling_price FROM drinks WHERE drink_id ='$drink_id'");
	if($query){return mysql_result($query,0,0);}
}
function getSold($stock_id){
	$query = mysql_query("SELECT sold FROM stock WHERE stock_id ='$stock_id'");
	if($query){return mysql_result($query,0,0);}
}

function calTrendy($drink_id){
	$query = mysql_query("SELECT * FROM stock WHERE drink_id='$drink_id' ORDER BY stock_id DESC LIMIT 1");
	if($query){
		$stock_closing_balance = mysql_result($query,0,7);
		$counter_closing_balance = mysql_result($query,0,11);
		$open_stock_store = mysql_result($query,0,4);
		$new_stock = mysql_result($query,0,5);
		
		$total_closing_balance = $stock_closing_balance + $counter_closing_balance;
		$total_stock =$open_stock_store+ $new_stock;
		$trendy = ($total_closing_balance/$total_stock)*100;
		return $trendy.'%' ;
	}
	
	
}
function calGenerealTrendy($drink_id,$from,$to){
	$query = mysql_query("SELECT * FROM stock WHERE drink_id = '$drink_id' and muuzaji_id >='$from' and muuzaji_id <='$to' ");
	if($query){
		if(mysql_num_rows($query) == 0){
			return "No stock records for those dates";
		}else{
			//Count the number of the row for division letter 
		$rows = 0;
		$trendy = 0;
		while($row = mysql_fetch_array($query)){
			
		$stock_closing_balance = $row['closing_balance_store'];
		$counter_closing_balance = $row['closing_stock_counter'];
		$open_stock_store = $row['open_stock_store'];
		$open_counter = $row['open_counter'];
		$new_stock = $row['new_stock'];
		
		$total_closing_balance = $stock_closing_balance + $counter_closing_balance;
		$total_stock =$open_stock_store+ $new_stock+$open_counter;
		$trendy += (100-($total_closing_balance/$total_stock)*100);
		
		$rows++;
		}
		//Calculate the average
		$day = 0;
		if($rows <= 1){$day="day";}else{$day="days";}
		return "Your Sells trend for $rows ".$day." is <span color='red'>".round(($trendy/$rows),1)."%</span> ".getAV(($trendy/$rows));
	
		}
		
		}
}

function getAV($percentage){
	if($percentage > 80){return "Exellent";}
	elseif($percentage > 60 ){return "very good";}
	elseif($percentage > 50){return "good";}
	else if($percentage > 40){return "average";}
	else if($percentage > 20){return "poor";}
	else if($percentage < 20){return "very poor";}
	
}

function getDates($drink_id){
	$query = mysql_query("SELECT muuzaji.muuzaji_id,muuzaji.date FROM muuzaji,stock WHERE muuzaji.muuzaji_id=stock.muuzaji_id AND stock.drink_id='$drink_id'");
	if($query){
		while($row = mysql_fetch_array($query)){
			?>
			<option value="<?php echo $row['muuzaji_id'] ?>"><?php echo $row['date'];?></option>
			<?php
		}
	}
}
function checkDateExistence($date,$cat_id){
	$query = mysql_query("SELECT COUNT(date) FROM muuzaji,stock WHERE muuzaji.date='$date' AND stock.cat_id='$cat_id' AND muuzaji.muuzaji_id=stock.muuzaji_id");
	if($query){
		if(mysql_result($query,0,0) > 0){
			return true;
		}else{ return FALSE;}
	}
}
function deleteStock($stock_id,$drink_id,$cat_id){
	$query = mysql_query("DELETE FROM stock WHERE stock_id='$stock_id'");
	if($query){
		viewSpecificStock($drink_id,$cat_id);
	}else{return false;}
}
function currency_format($num ) {
	setlocale(LC_MONETARY,"en_TZ");
	return money_format("%i", $num);
}
//Fuction to clear each table
function deleteDrinksTable(){
	$query = mysql_query("DELETE FROM drinks");
	if($query){return true;}else{return false;}
}
function deleteCategoryTable(){
	$query = mysql_query("DELETE FROM category");
	if($query){return true;}else{return false;}
}
function deleteMuuzajiTable(){
	$query = mysql_query("DELETE FROM muuzaji");
	if($query){return true;}else{return false;}
}
function deleteStockTable(){
	$query = mysql_query("DELETE FROM stock");
	if($query){return true;}else{return false;}
}
function getNumberStockRecords(){
	$query = mysql_query("SELECT COUNT(stock_id) FROM stock");
	if($query){return mysql_result($query,0,0);}else{return 0;}
}
function deleteRecordsTables(){
		deleteStockTable();deleteMuuzajiTable();
}
function getCategoryWithId($cat_id){
	$query = mysql_query("SELECT cat_name FROM category WHERE cat_id = '$cat_id'");
	if($query){return mysql_result($query,0,0);}else{return 'Category';}
}
?>









