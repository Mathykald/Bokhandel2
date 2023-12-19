<script src="script.js"></script> 
<?php
if (!isset($_SESSION)) {
    session_start();
}
	include_once "header.php";
	
	if(isset($_POST['submit_login'])){
		$loginReturn = $user->login();
		
		if($loginReturn == "success"){
			echo "Redirecting to: $url"; // Add this line
			$user->redirect("home.php");
		}
	}
?>



<div id="content">
	<div class="content-inner">
		<div class="wrapper fadeInDown">
			<div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
				<div class="fadeIn first">
				  <i class="fas fa-house-user login-icon"></i>
				  <h2>Log in</h2>
				</div>

				<!-- Login Form -->
				<form method="POST">
				  <input type="text" id="username" name="username" placeholder="User name">
				  <input type="password" id="password" name="password" placeholder="Password">
				  <input type="submit" name="submit_login" value="Log In">
				</form>

				<span>Not a user? </span><a class="underlineHover" href="register.php">Register here!</a>

			</div>
		</div>
	</div>
</div>
<?php
include_once "footer.php";
?>