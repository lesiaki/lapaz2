<div id="tab1">
    <form action="process.php" method="post" onsubmit="">
	<div class="catBar" id="fixadent">
		
		<input type="text" id="muuzaji_name" placeholder="Muuzaji" name="muuzaji" class="input" style="width: 200px;"/>
		<input type="text" id="siku" placeholder="Siku"   name="siku" class="input" style="width: 200px;"/>
		<input type="text" id="trh" placeholder="Tarehe (d/m/y)" value="<?php echo date('d/m/Y');?>" title="siku/mwezi/mwaka" name="date" class="input" style="width: 200px;"/>
	
	
				  <select id="selecter_basic" name="selecter_basic" class="selecter_basic" onchange="getDrinksJQ(value);return true;">
						<option>Select Category</option>
						<?php getCat(); ?>
					</select>
					<p class="validate_feedback" id="validate_feedback"></p>
				
	<hr class="hr" />
	</div>
	
		<div id="displayDrinks">
			<?php
			if(isset($_GET['f'])){
				$feedback = $_GET['f'];
				?>
				<p class="error"><?php echo $feedback; ?></p>
					<?php
				
			}else{
				?>
				<p class="alert">
					To Save records in stock control sheet, you must fill all information required including all input after select category
				</p>
				<?php
			}
			?>
		</div>
		
	<hr  class="hr"/>
	<div id="" class="">
		<input type="submit" value="SAVE" class="myButton" onclick="anable_input();return validate();">
		&nbsp;
		<a href="manage.php" class="myButton">Clear</a>
		
	</div>
	</form>
	</div>