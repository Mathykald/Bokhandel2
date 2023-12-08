
<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';
?>
<div class="bc">
<?php
$allCarBrands = selectAllBrands($conn);

if(isset($_GET['sortprice']) && $_GET['sortprice'] != 0){
	$sortCriteria = 'car_Price';
	$sortDirection = cleanInput($_GET['sortprice']);
	$selectedCars = selectSortedCars($conn, 20, $sortCriteria, $sortDirection);
}

else if(isset($_GET['sortmileage']) && $_GET['sortmileage'] != 0){
	$sortCriteria = 'car_Milage';
	$sortDirection = cleanInput($_GET['sortmileage']);
	$selectedCars = selectSortedCars($conn, 20, $sortCriteria, $sortDirection);
}

else {
	$selectedCars = selectCars($conn, 20);
	}

	echo "<div class='row'>";


    foreach ($selectedCars as $row){

    echo "
	<div id='bksomelese'class='card m-3 col-sm-3'>
		<img src='uploads/{$row['car_Img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
			<h5 class'card-title'>{$row['car_Brand']} {$row['car_Model']}</h5>
			<p class='card-text'><p>
		</div>
			<ul class='list-group list-group-flush'>
				<li class='list-group-item'>Milage: {$row['car_Milage']}</li>
				<li class='list-group-item'>Transmission: {$row['transmission_name']}</li>
				<li class='list-group-item'>Drivetype: {$row['drivetrain_name']}</li>
				<li class='list-group-item'>Price: {$row['car_Price']}€</li>
				<li class='list-group-item'>City: {$row['City']}</li>
			</ul>	
			 <a href='single_Car.php?carID={$row['car_id']}'>View full info</a> <a href='edit_Car.php?carID={$row['car_id']}'>Edit car info</a>
			 <a href='deletecar.php?carID={$row['car_id']}'>Delete car</a>
		</div>
		";
}
echo "</div>";
	

?>


<div class="sidebar col-sm-4 bg-light">    
	<form action="" method="GET" id="sortform">    
		<label for="sortprice">Sort by price:</label>
		<select name="sortprice" id="sortprice" onchange="submitSortForm()">
    		<option value="0">Choose..</option>
    		<option value="1">Yes</option>
    		<option value="2">No</option>
		</select> <br>
    	<label for="sortmileage">Sort by Mileage:</label>
    	<select name="sortmilage" id="sortmilage" onchange="submitSortForm()">
    		<option value="0">Choose..</option>
        	<option value="1">Yes</option>
        	<option value="2">No</option>
    	</select> <br>
    </form>       
	<form action="" method="GET" id="filterform">
	    <label for="filterbrand">Filter by brand:</label>
	        <select name="filterbrand" id="filterbrand" onchange="submitFilterForm()">
	            <option value="0">Choose..</option>
	            <?php                
					foreach($allCarBrands as $row){
		            	echo "<option value='{$row['car_Brand']}'>{$row['car_Brand']}</option>";
		            }?>
		    </select> <br>
		        <label for="filtertransmission">Filter by transmission:</label>
		        	<select name="filtertransmission" id="filtertransmission" onchange="submitFilterForm()">
		            	<option value="0">Choose..</option>
		<?php                
					foreach($allCarBrands as $row){
		            	echo "<option value='{$row['car_Gearbox_fk']}'>{$row['car_Gearbox_fk']}</option>";
		            }?>
		        	</select> <br>
	</form>
</div>


</div>
<?php include 'footer.php';?>