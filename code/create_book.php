<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  
  if(isset($_POST['article-submit'])){
	  
	 $lastInsertedCustomerId = createOwner($conn, $_POST['firstname'], $_POST['lastname'], $_POST['phonenumber'], $_POST['email'], $_POST['adress'], $_POST['zip'], $_POST['city']);
	  
	 createCar($conn, $_POST['brand'], $_POST['model'], $_POST['yearmodel'], $_POST['price'], $_POST['milage'], $_POST['licenseplate'], $_POST['engine'], $_POST['transmission_type'], $_POST['horse_power'], $_POST['fuel_consumtion'], $_POST['created'], $_FILES['cimage']['name'], $lastInsertedCustomerId, 1, $_POST['fuel_type'], $_POST['type_of_drive']);	
	  
	  
	  
	  
	 // echo $_post['firstname'];
	 // echo $files['cimage'] ['name'];
	 
	 
  }
  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Customer info</h3>

  <label id="mt" for="firstname">First name:</label><br>
  <input class="colorstuff" type="text" id="firstname" name="firstname" value=""><br><br>
  

  <label for="lastname">Last name:</label><br>
  <input class="colorstuff" type="text" id="lastname" name="lastname" value=""><br><br>


  <label for="phonenumber">Phonenumber</label><br>
  <input class="colorstuff" type="text" id="phonenumber" name="phonenumber" value=""><br><br>

  <label for="email">Email</label><br>
  <input class="colorstuff" type="" id="email" name="email" value=""><br><br>

  <label for="adress">Adress</label><br>
  <input class="colorstuff" type="" id="adress" name="adress" value=""><br><br>
  
  <label for="zip">Zip-code</label><br>
  <input class="colorstuff" type="" id="zip" name="zip" value=""><br><br>
  
  <label for="city">City</label><br>
  <input class="colorstuff" type="" id="city" name="city" value=""><br><br>
  
  
  <div id="cars">

  <h3>Car info</h3>
  
  <label for="brand">Brand</label><br>
  <input class="colorstuff" type="" id="brand" name="brand" required="required" value=""><br><br>
  
  <label for="model">Car model</label><br>
  <input class="colorstuff" type="" id="model" name="model" value=""><br><br>
  
   <label for="yearmodel">Year model</label><br>
  <input class="colorstuff" type="" id="yearmodel" name="yearmodel" value=""><br><br>
  
    <label for="fuel_type">fuel type</label><br>
    <select name="fuel_type" id="fuel_type" class="fuel_type"><br><br> 
  
	<?php
		$allFueltypes = fetchFueltypes($conn);
		foreach ($allFueltypes as $row){
			echo "<option value='{$row['fueltype_id']}'>{$row['fueltype_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  
    <label for="price">price</label><br>
  <input class="colorstuff" type="" id="price" name="price" value=""><br><br>
  
    <label for="milage">milage</label><br>
  <input class="colorstuff" type="" id="milage" name="milage" value=""><br><br>
  
    <label for="licenseplate">licenseplate</label><br>
  <input class="colorstuff" type="" id="licenseplate" name="licenseplate" value=""><br><br>
  

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
  <input class="colorstuff" type="" id="engine" name="engine" value=""><br><br>
  
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
  <input class="colorstuff" type="" id="horse_power" name="horse_power" value=""><br><br>
  
  <label for="fuel_consumtion">Fuel consumtion</label><br>
  <input class="colorstuff" type="" id="fuel_consumtion" name="fuel_consumtion" value=""><br><br>
  
  <label for="created">Created</label><br>
  <input class="colorstuff" type="date" id="created" name="created" value=""><br><br>
  
    <label for="cimage">Car image:</label><br>
	<input type="file" name="cimage" id="cimage">
 
  
  

  <input id="submit" type="submit" name="article-submit" value="Send">



</form>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>