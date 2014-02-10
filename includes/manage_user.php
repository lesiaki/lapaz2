
<div id="" class="manage_user_left">
	<?php
	if(getStatus($_SESSION['user_id'])){
		//Administrator only should see this
		?>
		<p class="title">Add User</p>
	<p>
		<select id="status_sel" name="selecter_basic" class="selecter_basic"  onchange="getRegisteredDrinksJQ(value);return true;">
						<option value="select_status" >Select Status</option>
						<option value="Administrator" >Adminstrator</option>
						<option value="Staff" >Staff</option>
						
	</select>
	</p>
	<p><input type="text" name="" id="user" class="input" placeholder="Username"/></p>
	<p><input type="password" name="" id="pass" class="input" placeholder="Password"/></p>
	<input type="submit" value="Add" class="myButton" onclick="addUser();" />
	&nbsp;
	<input type="button" value="Clear" class="myButton">
		<?php
	} 
	?>
	
	<p class="title">Change Password</p>
	<p><input type="password" name="" id="current_pass" class="input" placeholder="Current password"/></p>
	<p><input type="password" name="" id="new_pass" class="input" placeholder="New password"/></p>
	<div id="pwd_fb"></div>
	<input type="submit" value="Change" class="myButton" onclick="change();" />
	&nbsp;
	<input type="button" value="Clear" class="myButton">
	
</div>
<div id="" class="manage_user_right">
	<?php 
	if(getStatus($_SESSION['user_id'])){
		//Adminstrator only should see this
		?>
		<p class="title">Manage User</p>
	<div id="userList">
		<?php getAllUsers(); ?>
	</div>
		<?php
	}
	?>
	
</div>
