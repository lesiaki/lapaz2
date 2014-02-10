<div id="" class="register_left">
	<p class="title">Register Category</p>
	<table>
	<tr>
	<td>
	<input type="text" class="input" id="input_cat" placeholder="Category"/>
	</td>
	<td>
	<input type="submit" value="Register" class="myButton" onclick="addRegisterCat();">
	</td>
	</tr>
	</table>
	<p class="alert" id="alertLeft"></p>
	<hr class="hr" />
	<div style="height: 500px; overflow-y: auto;">
	<table id="registeredCategoryTable" class="registerTables">
		<?php getRegisteredCategory(); ?>
	</table>
	<p class="title">Stock Records</p>
	<p style="color:#999000;"><span style="color:#990000;"><?php echo getNumberStockRecords(); ?>&nbsp;</span>Records of Stock Available</p>
	<form action="manage.php" method="post">
	<p><input type="checkbox" value="" name="ckbx_dlt"/><span class="alert" style="font-size:12px;">Tick to delete the entire records</span><p>
	<input type="submit" class="myButton" name="btn_clear_all_stock"  value="Clear All Stock" />
	
	</form>
	<p><?php if(isset($_POST['btn_clear_all_stock'],$_POST['ckbx_dlt'])){deleteRecordsTables();}?></p>
	</div>
</div>
<div id="" class="register_right">
	<p class="title">Register Drinks</p>
	<table>
	<tr>
	<td width="150px" onmouseover="updateSelect();" id="selectTD">
	<select id="cat_selected" name="selecter_basic" class="selecter_basic"  onchange="getRegisteredDrinksJQ(value);return true;">
						<option>Select Category</option>
						<?php getCat(); ?>
	</select>
	</td>
	<td>
	<input type="text" class="input" id="drink_input" placeholder="Drink" style=""/>
	</td>
	<td>
	<input type="submit" value="Register" class="myButton" onclick="addDrink();">
	</td>
	</tr>
	<tr>
		<td><input id="buy_price" placeholder="Buy price" style="width:155px" type="text" name="" class="input"/></td>
		<td><input id="selling_price" placeholder="Selling price" type="text" name="" class="input"/></td>

	</tr>
	</table>
	<p class="alert" id="alert"></p>
	<hr  class="hr"/>
	<div style="height: 400px; overflow-y: auto;" >
	<table class="" id="registeredDrinksTable" width="450px;">
		
	</table>
	</div>
</div>