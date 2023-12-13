<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['bookID'])){

	$currentBook = $_GET['bookID'];

	$bookData = selectSingleBook($conn,$currentBook);



}

else{

    $errorMessage = "No book has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	 
	 
	 $a = updateBook($conn, $_POST['title'], $_POST['price'], $_POST['description'], $_FILES['bimage'], $_POST['pages'], $_POST['release_date'], $_POST['agerec'], $_POST['category'], $_POST['language'], $_POST['illustrator'], $_POST['publish']);	
	 var_dump($a);
	header("Refresh:1");
	  
	  
	  
	  
	 // echo $_post['firstname'];
	 // echo $files['bimage'] ['name'];
	 
	 
  }
  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="" enctype="multipart/form-data">
  
  <div id="cars">

  <h3>Book info</h3>
  
  <label for="title">title</label><br>
  <input class="colorstuff" type="" id="title" name="title" value="<?php if(isset($bookData['book_title'])){echo $bookData['book_title'];} ?>" required="required"><br><br>
  
  <label for="price">Car price</label><br>
  <input class="colorstuff" type="" id="price" value="<?php if(isset($bookData['book_price'])){echo $bookData['book_price'];} ?>" name="price"><br><br>
  
   <label for="yearprice">Year price</label><br>
  <input class="colorstuff" type="" id="yearprice" value="<?php if(isset($bookData['book_Year_price'])){echo $bookData['book_Year_price'];} ?>" name="yearprice"><br><br>
  
    <label for="fuel_type">fuel type</label><br>
    <select name="fuel_type" id="fuel_type" value="<?php if(isset($bookData['fueltype_name'])){echo $bookData['fueltype_name'];} ?>" class="fuel_type"><br><br> 
  
	<?php
		$allFueltypes = fetchFueltypes($conn);
		foreach ($allFueltypes as $row){
			echo "<option value='{$row['fueltype_id']}'>{$row['fueltype_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  
    <label for="price">price</label><br>
  <input class="colorstuff" type="" id="price" value="<?php if(isset($bookData['book_Price'])){echo $bookData['book_Price'];} ?>" name="price"><br><br>
  
    <label for="milage">milage</label><br>
  <input class="colorstuff" type="" id="milage" value="<?php if(isset($bookData['book_Milage'])){echo $bookData['book_Milage'];} ?>" name="milage"><br><br>
  
    <label for="licenseplate">licenseplate</label><br>
  <input class="colorstuff" type="" id="licenseplate" value="<?php if(isset($bookData['book_Licens_number'])){echo $bookData['book_Licens_number'];} ?>" name="licenseplate"><br><br>
  

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
  <input class="colorstuff" type="" id="engine" value="<?php if(isset($bookData['book_Engine'])){echo $bookData['book_Engine'];} ?>" name="engine"><br><br>
  
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
  <input class="colorstuff" type="" id="horse_power" value="<?php if(isset($bookData['book_Horsepower'])){echo $bookData['book_Horsepower'];} ?>" name="horse_power"><br><br>
  
  <label for="fuel_consumtion">Fuel consumtion</label><br>
  <input class="colorstuff" type="" id="fuel_consumtion" value="<?php if(isset($bookData['book_Fuel_consumtion'])){echo $bookData['book_Fuel_consumtion'];} ?>" name="fuel_consumtion"><br><br>
  
  <label for="created">Created</label><br>
  <input class="colorstuff" type="" id="created" value="<?php if(isset($bookData['book_created'])){echo $bookData['book_created'];} ?>" name="created"><br><br>
  
    <label for="bimage">Car image:</label><br>
	<input type="file" name="bimage" id="bimage">

  
  
	<input type="radio" name="carStatus" value="1"  <?php if($bookData['book_status_fk'] == 1){echo "checked";} ?> >
	<label for="carStatus">For Sale</label>
	<input type="radio" name="carStatus" value="2"  <?php if($bookData['book_status_fk'] == 2){echo "checked";} ?>>
	<label for="carStatus">Sold</label>
	
  <input id="submit" type="submit" name="article-updated" value="Uppdate"><br>



</form>
</div>
</div>
</div>
</div>

