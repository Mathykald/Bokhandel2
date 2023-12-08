
<?php 
include 'header.php';
include 'includes/functions.php';
include 'includes/config.php';
?>
<div class="bc">
<?php
$errorMessage = "";




if(isset($_GET['carID'])){

$currentCar = $_GET['carID'];

$carData = selectSingleCar($conn,$currentCar);



}

else{

    $errorMessage = "No car has been chosen.";

}




?>



<p class="error-message m-0">

<?php

if($errorMessage != ""){

    echo $errorMessage;

    }
	
echo "</p>";
	
echo "<div id='yes'>";
echo "<h1 class='pt-3'>{$carData['car_Brand']}</h1>";
	echo "<img src='uploads/{$carData['car_Img']}' id='maregin' class='' alt'...'>. '<br>'";
echo"</div>";
echo"<div class='pb-5 marginsinglecar'>";
echo"<table id='padb' class='table table-dark'>
  <thead>
    <tr>
      <th scope='col'>Brand</th>
      <th scope='col'>Model</th>
      <th scope='col'>Yearmodel</th>
      <th scope='col'>Price</th>
      <th scope='col'>Milage</th>
      <th scope='col'>Licensnumber</th>
      <th scope='col'>Engine</th>
      <th scope='col'>transmission type</th>
      <th scope='col'>Horsepower</th>
      <th scope='col'>Fuel consumtion</th>
      <th scope='col'>created</th>
	  <th scope='col'>name</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>{$carData['car_Brand']}</th>
      <td>{$carData['car_Model']}</td>
      <td>{$carData['car_Year_model']}</td>
      <td>{$carData['car_Price']}€</td>
      <td>{$carData['car_Milage']}km</td>
      <td>{$carData['car_Licens_number']}</td>
      <td>{$carData['car_Engine']}l</td>
      <td>{$carData['transmission_name']}</td>
      <td>{$carData['car_Horsepower']}hp</td>
      <td>{$carData['car_Fuel_consumtion']}</td>
      <td>{$carData['car_created']}</td>
      <td>{$carData['First_name']}</td>
	  
    </tr>
  </tbody>
</table>";
echo"</div>";


?>



</div>
<?php include 'footer.php' ?>