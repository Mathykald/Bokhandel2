<?php
include_once "header.php";

/*if(!$user->checkLoginStatus()){
	$user->redirect("index.php");
}*/

if ($user->checkLoginStatus()) {
    if ($user->checkUserRole(50) && isset($_GET['userToEdit'])) {
        $userToEdit = $_GET['userToEdit'];
    } else {
        // Check if the key 'uid' is set in the $_SESSION array
        $userToEdit = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

        // You might want to handle the case where 'uid' is not set according to your application's logic.
        // For example, redirect to an error page or display an error message.
		echo "userToEdit: " . $userToEdit . "<br>";
    }
}

if(isset($_POST['submit_edit'])){
	
	$checkReturn = $user->checkUserRegisterInput();
		
		//If all checks are passed, run register-fuction
		if($checkReturn == "success"){
			if($user->editUserInfo($userToEdit)){
			$feedback = "user info updated successfully";
			}
		}
		//If something does not meet requirements, echo out what went wrong.
		else {
			$feedback =$checkReturn;
		}	
}

if(isset($_POST['submit_role_status'])){
	if($_POST['update_status'] != 0){
	$statusUpdateReturn = $user->updateUserStatus($userToEdit);
		if($statusUpdateReturn == "success"){
			$feedback = "User status updated successfully!";
		}
		else {
			$feedback = $statusUpdateReturn;
		}	
	}
	else {
		$feedback = "No changes where made to user status.";
	}
	if($_POST['update_role'] != 0){
	$statusUpdateReturn = $user->updateUserRole($userToEdit);
		if($statusUpdateReturn == "success"){
			$feedback .= " User role updated successfully!";
		}
		else {
			$feedback = $statusUpdateReturn;
		}	
	}
	else {
		$feedback .= " No changes where made to user role";
	}
	
}


$userInfo = $user->getUserInfo($userToEdit);
$roleInfo = $conn->query("SELECT * FROM role_table");
$statusInfo = $conn->query("SELECT * FROM user_status_table");


?>
<div id="content">
<div class="feedback-section">
<?php
if(isset($feedback)){
	echo $feedback;
}


?>
</div>
<div class="content-inner">
	<?php 
        if (isset($_SESSION["uname"])) {
			echo "<h2>Välkommen " . $_SESSION["uname"] . "</h2>";
		}
	?>
	
	<h2> Change account info </h2>
	<form method="POST" action="">
	<label for="username">Username</label><br>
	  <input type="text" id="username" name="username" value="<?php echo $userInfo['u_username']; ?>" disabled><br>
	  <label for="password">Password</label><br>
	  <input type="password" id="password"name="password" ><br>
	  <label for="password-repeat">Password (repeat)</label><br>
	  <input type="password" id="password-repeat" name="password_confirm" ><br>
	  <label for="firstname ">First name</label><br>
	  <input type="text" id="firstname" name="firstname" value="<?php echo $userInfo['u_firstname']; ?>"><br>
	  <label for="lastname">Last name</label><br>
	  <input type="text" id="lastname" name="lastname" value="<?php echo $userInfo['u_lastname']; ?>"><br>
	  <label for="email-field">Email</label><br>
	  <input type="text" id="email-field" name="email-field" value="<?php echo $userInfo['u_email']; ?>">
	  <br>
	  <input type="submit" name="submit_edit" value="Submit new info">
	</form>
	
	<?php 
		if($user->checkUserRole(50)){
	?>
	
	<form method="POST" action="">
		<select name="update_status">
			<option value='0'>Change user status</option>
			<?php 
			foreach ($statusInfo as $row){
			echo "<option value='{$row['s_id']}'>{$row['s_name']}</option>" ;
			}
			?>
		</select>
		<select name="update_role">
		<option value='0'>Change user role</option>
			<?php foreach ($roleInfo as $row){
			echo "<option value='{$row['r_ID']}'>{$row['r_name']}</option>" ;
			} ?>
		</select>
	  <input type="submit" name="submit_role_status" value="Update">
	</form>
	
	<form method="POST" action="confirm_delete.php?userToEdit=<?php echo $userToEdit; ?>">
	  <input type="submit" name="submit_user_delete" value="Delete this account">
	</form>
	
<?php } ?>
</div>
</div>
<?php
include_once "footer.php";
?>