
<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';
	include 'header.php';
	
	$errorMessage = "";
	if(isset($_GET['carID'])){
		$currentCar = $_GET['carID'];
		$carData = selectSingleCar($conn,$currentCar);
		}
		
		else {
			$errorMessage = "No book selected";
		}
		

		
		if(isset($_POST['deletecar'])){ 
		if(deleteCar($conn, $currentCar)){
		header('Location: index.php?carDeleted=1'); 
		}}
		
		
		
		
?>
<div class="bc">
<?php
echo "Do you want to delete " . $carData['car_Brand'] . "  " . $carData['car_Model'] . "?";
?>

<form method="POST" action="">    <input type="submit" name="deletecar" value="Delete">    <input type="submit" name="goback" value="Go back"></form>


</div>
<?php include 'footer.php';?>