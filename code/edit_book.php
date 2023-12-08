<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['carID'])){

	$currentCar = $_GET['carID'];

	$carData = selectSingleCar($conn,$currentCar);



}

else{

    $errorMessage = "No car has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	  
	 updateOwner($conn, $_POST['firstname'],$_POST['lastname'], $_POST['phonenumber'], $_POST['email'], $_POST['adress'], $_POST['zip'], $_POST['city'], $carData['car_owner_fk']);
	 
	 
	 $a = updateCar($conn, $_GET['carID'], $_POST['brand'], $_POST['model'], $_POST['yearmodel'], $_POST['fuel_type'], $_POST['price'], $_POST['milage'], $_POST['licenseplate'], $_POST['type_of_drive'], $_POST['engine'], $_POST['transmission_type'], $_POST['horse_power'], $_POST['fuel_consumtion'], $_POST['created'], $_FILES['cimage']['name'], $_POST['carStatus']);	
	 var_dump($a);
	header("Refresh:1");
	  
	  
	  
	  
	 // echo $_post['firstname'];
	 // echo $files['cimage'] ['name'];
	 
	 
  }
  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center" >Customer info</h3>

  <label id="mt" for="firstname">First name:</label><br>
  <input class="colorstuff" type="text" id="firstname" value="<?php if(isset($carData['First_name'])){echo $carData['First_name'];} ?>" name="firstname"><br><br>
   

  <label for="lastname">Last name:</label><br>
  <input class="colorstuff" type="text" id="lastname" value="<?php if(isset($carData['Last_name'])){echo $carData['Last_name'];} ?>"  name="lastname"><br><br>


  <label for="phonenumber">Phonenumber</label><br>
  <input class="colorstuff" type="text" id="phonenumber" value="<?php if(isset($carData['Phonenumber'])){echo $carData['Phonenumber'];} ?>" name="phonenumber"><br><br>

  <label for="email">Email</label><br>
  <input class="colorstuff" type="" id="email"  value="<?php if(isset($carData['E_post'])){echo $carData['E_post'];} ?>" name="email"><br><br>

  <label for="adress">Adress</label><br>
  <input class="colorstuff" type="" id="adress" value="<?php if(isset($carData['Adress'])){echo $carData['Adress'];} ?>" name="adress"><br><br>
  
  <label for="zip">Zip-code</label><br>
  <input class="colorstuff" type="" id="zip" value="<?php if(isset($carData['Post_code'])){echo $carData['Post_code'];} ?>" name="zip"><br><br>
  
  <label for="city">City</label><br>
  <input class="colorstuff" type="" id="city" value="<?php if(isset($carData['City'])){echo $carData['City'];} ?>" name="city"><br><br>
  
  
  <div id="cars">

  <h3>Car info</h3>
  
  <label for="brand">Brand</label><br>
  <input class="colorstuff" type="" id="brand" name="brand" value="<?php if(isset($carData['car_Brand'])){echo $carData['car_Brand'];} ?>" required="required"><br><br>
  
  <label for="model">Car model</label><br>
  <input class="colorstuff" type="" id="model" value="<?php if(isset($carData['car_Model'])){echo $carData['car_Model'];} ?>" name="model"><br><br>
  
   <label for="yearmodel">Year model</label><br>
  <input class="colorstuff" type="" id="yearmodel" value="<?php if(isset($carData['car_Year_model'])){echo $carData['car_Year_model'];} ?>" name="yearmodel"><br><br>
  
    <label for="fuel_type">fuel type</label><br>
    <select name="fuel_type" id="fuel_type" value="<?php if(isset($carData['fueltype_name'])){echo $carData['fueltype_name'];} ?>" class="fuel_type"><br><br> 
  
	<?php
		$allFueltypes = fetchFueltypes($conn);
		foreach ($allFueltypes as $row){
			echo "<option value='{$row['fueltype_id']}'>{$row['fueltype_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  
    <label for="price">price</label><br>
  <input class="colorstuff" type="" id="price" value="<?php if(isset($carData['car_Price'])){echo $carData['car_Price'];} ?>" name="price"><br><br>
  
    <label for="milage">milage</label><br>
  <input class="colorstuff" type="" id="milage" value="<?php if(isset($carData['car_Milage'])){echo $carData['car_Milage'];} ?>" name="milage"><br><br>
  
    <label for="licenseplate">licenseplate</label><br>
  <input class="colorstuff" type="" id="licenseplate" value="<?php if(isset($carData['car_Licens_number'])){echo $carData['car_Licens_number'];} ?>" name="licenseplate"><br><br>
  

    <label for="type_of_drive">Type of drive</label><br>
  <select name="type_of_drive" id="type_of_drive" class="type_of_drive"><br><br> 
  
	<?php
		$alldrivetrainTypes = fetchDrivetrain($conn);
		foreach ($alldrivetrainTypes as $row){
			echo "<option value='{$row['drivetrain_id']}'>{$row['drivetrain_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  <label for="engine">engine</label><br>
  <input class="colorstuff" type="" id="engine" value="<?php if(isset($carData['car_Engine'])){echo $carData['car_Engine'];} ?>" name="engine"><br><br>
  
  <label for="transmission">Transmission</label><br>
  <select name="transmission_type" id="transmission_type" class="transmission_type"><br><br> 
  
	<?php
		$allTransmissionTypes = fetchTransmissions($conn);
		foreach ($allTransmissionTypes as $row){
			echo "<option value='{$row['transmission_id']}'>{$row['transmission_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  <label for="horse_power">Horse power</label><br>
  <input class="colorstuff" type="" id="horse_power" value="<?php if(isset($carData['car_Horsepower'])){echo $carData['car_Horsepower'];} ?>" name="horse_power"><br><br>
  
  <label for="fuel_consumtion">Fuel consumtion</label><br>
  <input class="colorstuff" type="" id="fuel_consumtion" value="<?php if(isset($carData['car_Fuel_consumtion'])){echo $carData['car_Fuel_consumtion'];} ?>" name="fuel_consumtion"><br><br>
  
  <label for="created">Created</label><br>
  <input class="colorstuff" type="" id="created" value="<?php if(isset($carData['car_created'])){echo $carData['car_created'];} ?>" name="created"><br><br>
  
    <label for="cimage">Car image:</label><br>
	<input type="file" name="cimage" id="cimage">

  
  
	<input type="radio" name="carStatus" value="1"  <?php if($carData['car_status_fk'] == 1){echo "checked";} ?> >
	<label for="carStatus">For Sale</label>
	<input type="radio" name="carStatus" value="2"  <?php if($carData['car_status_fk'] == 2){echo "checked";} ?>>
	<label for="carStatus">Sold</label>
	
  <input id="submit" type="submit" name="article-updated" value="Uppdate"><br>



</form>
</div>
</div>
</div>
</div>

