<?php
function login($username, $password) {
	if (isset($username, $password)) {

		if ($username == "" || $password == "") {
			echo "all input must be filled";
		} else {
			$username = mysql_real_escape_string(htmlentities($username));
			$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' AND password= '".md5($password)."'");
			if ($query) {
				if (mysql_result($query, 0, 0) == 1) {
					$_SESSION['user_id'] = getUserID($username, $password);
					header("Location:manage.php");
					exit();
				} else {
					echo "Username or password invalid";
				}
			}
		}

	}

}
function getUserID($username, $password){
	$query = mysql_query("SELECT user_id FROM users WHERE username = '$username' AND password= '".md5($password)."'");
	if($query){return mysql_result($query,0,0);}
}
function addNewUser($user,$pass,$status){
	$user = mysql_real_escape_string(htmlentities($user));
	$query = mysql_query("INSERT INTO users VALUES('','$user','".md5($pass)."','$status')");
	if($query){
		getAllUsers();
	}
}
function getAllUsers(){
	$query = mysql_query("SELECT * FROM users");
	if($query){
		if(mysql_num_rows($query) == 0){
			?> <p class="error">No user added yet!</p> <?php
		}else{
			?>
		<table width="400px;" class="table">
			<tr class="tr1">
				<td>Names</td>
				<td>Status</td>
				<td>Delete</td>
			</tr>
		<?php
		while($row = mysql_fetch_array($query)){
			?>
			<tr>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['status']; ?></td>
				<?php if($row['username'] != 'admin' && $row['password']!=md5("admin")){
					?>
					<td id="dlt_logo">
						<a title="Delete" href="javascript:void(0);" onclick="javascript:deleteUser(<?php echo $row['user_id'];?>)">
						<img src="images/drop.png">
						</a>
					</td>
			
					<?php
				}?>
				</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
		}
		
}

function deleteUserFromTable($deleteUserID){
	$query = mysql_query("DELETE FROM users WHERE user_id = '$deleteUserID'");
	if($query){
		getAllUsers();
	}
}

function getStatus($user_id){
	$query = mysql_query("SELECT status FROM users WHERE user_id = '$user_id'");
	if($query){
		 if(mysql_result($query,0,0) == "Administrator"){return true;}
		 else{
					return false;
				}
	}
}

function changePassword($current_pass,$new_pass){
	if(currentPassword($current_pass)){
		$query = mysql_query("UPDATE users SET password = '".md5($new_pass)."' WHERE user_id = '".$_SESSION['user_id']."'");
		if($query){
			?>
		<p class="alert">Password Succeful changed</p>
		<?php
			
		}else{
			
			?>
		<p class="error">Password fail to change</p>
		<?php
			
		}
	}else{
		?>
		<p class="error">Password fail to change</p>
		<?php
	}
}
function currentPassword($current_pass){
	$query = mysql_query("SELECT COUNT(password) FROM users WHERE password = '".md5($current_pass)."' AND user_id = '".$_SESSION['user_id']."'");
	if($query){
		if(mysql_result($query,0,0) == 1){
			return true;
		}else{return false;}
	}
}

function getUserName(){
	$query = mysql_query("SELECT username FROM users WHERE user_id = '".$_SESSION['user_id']."'");
	if($query){echo mysql_result($query,0,0);}
}







?>