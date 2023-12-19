<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
class USER {
	
	public $errorMessage;
	
	public function __construct($pdo){
		$this->conn = $pdo;
	}
	
	private function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	public function checkUserRegisterInput(){
		$error = 0;
		
		$cleanemail = $this->cleanInput($_POST['email-field']);
		
		if(isset($_POST['submit_register'])){
			$cleanname = $this->cleanInput($_POST['username']);
			//Bygg query som hämtar ut en rad ur databasen ifall användarnamnet finns
			$stmt_checkIfUserExists = $this->conn->prepare("SELECT * FROM user_table WHERE u_username = :uname OR u_email = :email");
			$stmt_checkIfUserExists->bindValue(":uname", $cleanname, PDO::PARAM_STR);
			$stmt_checkIfUserExists->bindValue(":email", $cleanemail, PDO::PARAM_STR);
			$stmt_checkIfUserExists->execute();
			//Skapa array av infon som hämtats
			$userNameMatch = $stmt_checkIfUserExists->fetch();
			//Kolla om arrayen innehåller värden. Om SELECT-queryn har hämtat ut något finns användarnamnet redan skapat
			
			if(!empty($userNameMatch)){
				if($userNameMatch['u_username'] == $cleanname){
					$this->errorMessage .= " | Username is already taken";
					$error=1;
					
				}
				
				if($userNameMatch['u_email'] == $cleanemail){
					$this->errorMessage .= " | Email is already taken";
					$error=1;
				
				}
			}
		}
			if(isset($_POST['submit_edit']) && $_POST['password'] == ""){
				
			}
			
			else {
				if($_POST['password'] != $_POST['password_confirm']){
						$this->errorMessage .= " | Passwords do not match";
						$error=1;
						
				}
				
				if(strlen($_POST['password']) < 8){
						$this->errorMessage .= " | Password does not meet requirements";
						$error=1;
				}
			}
			
			if (!filter_var($_POST['email-field'], FILTER_VALIDATE_EMAIL)) {
					$this->errorMessage .= "Invalid email format";
					$error=1;
			}
			
			if($error !=0){
				return $this->errorMessage;
			}
			else {
				return "success";
			}
		}
		
		public function register(){
			$cleanName = $this->cleanInput($_POST['username']);
			$cleanEmail = $this->cleanInput($_POST['email-field']);
			$cleanFname = $this->cleanInput($_POST['firstname']);
			$cleanLname = $this->cleanInput($_POST['lastname']);
			//Encrypt password with the password_hash-function
			$encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			$stmt_registerUser = $this->conn->prepare("INSERT INTO user_table 
			(u_username, u_firstname, u_lastname, u_email, u_password, u_role, u_status) 
			VALUES (:uname, :ufirst, :ulast, :umail, :upass, 1, 1)");
			$stmt_registerUser->bindValue(":uname", $cleanName, PDO::PARAM_STR);
			$stmt_registerUser->bindValue(":ufirst", $cleanFname, PDO::PARAM_STR);
			$stmt_registerUser->bindValue(":ulast", $cleanLname, PDO::PARAM_STR);
			$stmt_registerUser->bindValue(":umail", $cleanEmail, PDO::PARAM_STR);
			$stmt_registerUser->bindValue(":upass", $encryptedPassword, PDO::PARAM_STR);
			$check = $stmt_registerUser->execute();
			
			if($check){
				return "User created successfully!";
			}
			else{
				return "Something went wrong, try again later!";
			}	
		}
		
		public function login() {
			$usernameEmail = $this->cleanInput($_POST['username']);
		
			$stmt_checkIfUserExists = $this->conn->prepare("SELECT * FROM user_table WHERE u_username = :uname OR u_email = :email");
			$stmt_checkIfUserExists->bindValue(":uname", $usernameEmail, PDO::PARAM_STR);
			$stmt_checkIfUserExists->bindValue(":email", $usernameEmail, PDO::PARAM_STR);
			$stmt_checkIfUserExists->execute();
		
			$userNameMatch = $stmt_checkIfUserExists->fetch();
		
			if (!$userNameMatch) {
				$this->errorMessage = "No such user or email in the database.";
				return $this->errorMessage;
			}
			$enteredPasswordBytes = unpack('C*', $_POST['password']);
$hashedPasswordBytes = unpack('C*', $userNameMatch['u_password']);

if ($enteredPasswordBytes === $hashedPasswordBytes) {
    echo "Raw Bytes Match: Yes<br>";
} else {
    echo "Raw Bytes Match: No<br>";
}
$enteredPasswordHex = unpack('C*', $_POST['password']);
$enteredPasswordHex = unpack('C*', $userNameMatch['u_password']);

if ($enteredPasswordHex === $enteredPasswordHex) {
    echo "Raw hex Match: Yes<br>";
} else {
    echo "Raw hex Match: No<br>";
}
// Convert the raw bytes of the entered password to a string
$enteredPasswordString = implode('', array_map('chr', $enteredPasswordBytes));

// Convert the raw bytes of the hashed password from the database to a string
$hashedPasswordString = implode('', array_map('chr', $hashedPasswordBytes));

// Compare the two strings directly
if ($enteredPasswordString === $hashedPasswordString) {
    echo "Raw password Match: Yes<br>";
} else {
    echo "Raw password Match: No<br>";
}

			echo "Entered Password Hex: " . bin2hex($_POST['password']) . "<br>";
echo "Hashed Password Hex: " . bin2hex($userNameMatch['u_password']) . "<br>";
			echo "Entered Password Length: " . strlen($_POST['password']) . "<br>";
			echo "Hashed Password Length: " . strlen($userNameMatch['u_password']) . "<br>";	
			// Display the entered password from the form (without hashing)
			echo "Entered Password from Form: " . $_POST['password'] . "<br>";
		
			// Display the hashed password retrieved from the database
			echo "Hashed Password from Database: " . $userNameMatch['u_password'] . "<br>";
		
			// Compare the entered password with the hashed password from the database
			$checkPasswordMatch = password_verify(trim($_POST['password']), $userNameMatch['u_password']);
			echo "Password Match Result: " . ($checkPasswordMatch ? 'Yes' : 'No') . "<br>";
			$checkPasswordMatch = password_verify($enteredPasswordString, $hashedPasswordString);
			echo "Password Match Result (direct string comparison): " . ($checkPasswordMatch ? 'Yes' : 'No') . "<br>";
			
			// Debugging: Print user information
			print_r($userNameMatch);
		
			if ($checkPasswordMatch) {
				echo "Login successful";
				$_SESSION['uname'] = $userNameMatch['u_username'];
				$_SESSION['urole'] = $userNameMatch['u_role'];
				$_SESSION['uid'] = $userNameMatch['u_ID'];
				return "success";
			} else {
				$this->errorMessage = "Invalid password";
				return $this->errorMessage;
			}
		}
		
		
		public function checkLoginStatus(){
			if(isset($_SESSION['uid'])){
				return true;
			}
			else {
				return false;
			}
		}
		
		public function checkUserRole($req){
			$stmt_checkRoleLevel = $this->conn->prepare("SELECT * FROM role_table WHERE r_ID = :urole");
			$stmt_checkRoleLevel->bindValue(":urole", $_SESSION['urole'], PDO::PARAM_STR);
			$stmt_checkRoleLevel->execute();
			$currentUserRoleInfo = $stmt_checkRoleLevel->fetch();
			
			if($currentUserRoleInfo["r_level"] >= $req){
				return true;
			}
			else {
				return false;
			}
			
		}
		
		public function redirect($url){
			header("Location: ".$url);
			exit();
		}
		
		public function logout(){
			session_unset();
			session_destroy();
			return true;
		}
		
		public function editUserInfo($uid){
		//	$cleanName = $this->cleanInput($_POST['username']);
			$cleanEmail = $this->cleanInput($_POST['email-field']);
			$cleanFname = $this->cleanInput($_POST['firstname']);
			$cleanLname = $this->cleanInput($_POST['lastname']);
			
			if(isset($_POST['password']) && $_POST['password'] != ""){
				$encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$editUserInfo = $this->conn->prepare("UPDATE user_table SET u_email = :uemail, u_firstname = :ufname, u_lastname = :ulname, u_password = :upass WHERE u_ID = :uid");
				$editUserInfo->bindParam(":uemail", $cleanEmail, PDO::PARAM_STR);
				$editUserInfo->bindParam(":ufname", $cleanFname, PDO::PARAM_STR);
				$editUserInfo->bindParam(":ulname", $cleanLname, PDO::PARAM_STR);
				$editUserInfo->bindParam(":upass", $encryptedPassword, PDO::PARAM_STR);
				$editUserInfo->bindParam(":uid", $uid, PDO::PARAM_INT);
			}
			
			else{
				$editUserInfo = $this->conn->prepare("UPDATE user_table SET u_email = :uemail, u_firstname = :ufname, u_lastname = :ulname WHERE u_ID = :uid");
				$editUserInfo->bindParam(":uemail", $cleanEmail, PDO::PARAM_STR);
				$editUserInfo->bindParam(":ufname", $cleanFname, PDO::PARAM_STR);
				$editUserInfo->bindParam(":ulname", $cleanLname, PDO::PARAM_STR);
				$editUserInfo->bindParam(":uid", $uid, PDO::PARAM_INT);
			}
			
			if($editUserInfo->execute()){
				return true;
			}
		
		
		}
			
		public function getUserInfo($uid){
			$userInfoQuery = $this->conn->prepare("SELECT * FROM user_table WHERE u_ID = :uid");
			$userInfoQuery->bindParam(":uid", $uid, PDO::PARAM_INT);
			$userInfoQuery->execute();
			$userInfo = $userInfoQuery->fetch();
			return $userInfo;
		}
		
		public function searchUsers(){
			$cleanSearchParam = $this->cleanInput($_POST['search_username']);
			$cleanSearchParam = "%".$cleanSearchParam."%";
			$searchUsersQuery = $this->conn->prepare("SELECT * FROM user_table WHERE u_username LIKE :searchParam");
			$searchUsersQuery->bindParam(":searchParam", $cleanSearchParam, PDO::PARAM_STR);
			$searchUsersQuery->execute();
			return $searchUsersQuery;			
		}

		public function updateUserStatus($uid){
				$updateStatusQuery = $this->conn->prepare("UPDATE user_table SET u_status = :status WHERE u_ID = :uid");
				$updateStatusQuery->bindParam(":status", $_POST['update_status'], PDO::PARAM_INT);
				$updateStatusQuery->bindParam(":uid", $uid, PDO::PARAM_INT);
				if($updateStatusQuery->execute()){
					return "success";
				}
				else{
					$this->errorMessage = "Something went wrong, try again later or contact an administrator.";
					return $this->errorMessage;
				}
		}
				
		public function updateUserRole($uid){
				$updateRoleQuery = $this->conn->prepare("UPDATE user_table SET u_role = :role WHERE u_ID = :uid");
				$updateRoleQuery->bindParam(":role", $_POST['update_role'], PDO::PARAM_INT);
				$updateRoleQuery->bindParam(":uid", $uid, PDO::PARAM_INT);
				if($updateRoleQuery->execute()){
					return "success";
				}
				else{
					$this->errorMessage = "Something went wrong, try again later or contact an administrator.";
					return $this->errorMessage;
				}
				
		}
		public function deleteUser($uid){
				$deleteUserQuery = $this->conn->prepare("DELETE FROM user_table WHERE u_ID = :uid");
				$deleteUserQuery->bindParam(":uid", $uid, PDO::PARAM_INT);
				if($deleteUserQuery->execute()){
					return "success";
				}
				else{
					$this->errorMessage = "Something went wrong, try again later or contact an administrator.";
					return $this->errorMessage;
				}
				
		}
	}

		


?>

	