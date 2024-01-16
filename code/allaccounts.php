<?php
include_once "header.php";

if($user->checkLoginStatus()){
	if(!$user->checkUserRole(50)){
		
	}
}
else{
	$user->redirect("index.php");
}

if(isset($_POST['searchuser_submit'])){
	$userList = $user->searchUsers();
}


?>
<div id="content">
<div class="error-section">
<?php


?>
</div>
<div class="content-inner">
	<?php 
	echo "<h3>Välkommen " . $_SESSION["uname"] . "</h2>";  
	
	?>

	<form method="POST" action="">
		<label for="searchinput">Sök efter användare</label><br>
		  <input type="text" id="searchinput" name="search_username" placeholder="Ange användarnamn här">
		  
		  <input type="submit" name="searchuser_submit" class="mb-4" value="Sök">
	</form>

	<div class="userlist">
		<?php 
		if(isset($userList)){
			foreach ($userList as $row){
				echo "<p>{$row['u_username']} <a href='account.php?userToEdit={$row['u_ID']}'>Edit user</a></p>";
			}
		}
			?>
	</div>

</div>

</div>
<?php
include_once "footer.php";
?>