




<?php
	
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	
	function createOwner($conn, $firstName, $lastName, $mail, $phoneNumber, $address, $zip, $city ){
		
		$stmt_insertOwner = $conn->prepare("INSERT INTO table_owners (First_name, Last_name, E_post, Phonenumber, Adress, Post_code, City) VALUES (:firstname, :lastname, :mail, :phone, :address, :zip, :city)");
		$stmt_insertOwner->bindParam(':firstname', $firstName, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':lastname', $lastName, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':mail', $mail, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':phone', $phoneNumber, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':zip', $zip, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':city', $city, PDO::PARAM_STR);
		$stmt_insertOwner->execute();
		
		$insertedOwnerId = $conn->lastInsertId();
		return $insertedOwnerId;
	}
	
	function createCar($conn, $brand, $model, $yearmodel, $price, $milage, $license, $engine, $transmission, $horsepower, $fuelconsumtion, $created, $image, $lastId, $status, $fueltype, $drivetrain ){
		
		$stmt_insertOwner = $conn->prepare("INSERT INTO table_cars (car_Brand, car_Model, car_Year_model, car_Price, car_Milage, car_Licens_number, car_Engine, car_Gearbox_fk, car_Horsepower, car_Fuel_consumtion, car_created, car_Img, car_owner_fk, car_status_fk, car_fueltype_fk, drivetrain_fk) 
		VALUES (:brand, :model, :year, :price, :milage, :license, :engine, :gearbox, :horsepower, :fuelconsumtion, :created, :image, :owner, :status, :fueltype, :drivetrain)");
		$stmt_insertOwner->bindParam(':brand', $brand, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':model', $model, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':year', $yearmodel, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':price', $price, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':milage', $milage, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':license', $license, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':engine', $engine, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':gearbox', $transmission, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':horsepower', $horsepower, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':fuelconsumtion', $fuelconsumtion, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':created', $created, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':image', $image, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':owner', $lastId, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':status', $status, PDO::PARAM_INT);
		$stmt_insertOwner->bindParam(':fueltype', $fueltype, PDO::PARAM_INT);
		$stmt_insertOwner->bindParam(':drivetrain', $drivetrain, PDO::PARAM_STR);
		$stmt_insertOwner->execute();
		

	}
	
	function updateOwner($conn, $firstName, $lastName, $mail, $phoneNumber, $address, $zip, $city, $oid ){
		
		$stmt_insertOwner = $conn->prepare("
		UPDATE table_owners 
		SET First_name = :firstname, Last_name = :lastname, E_post = :mail, Phonenumber = :phone, Adress = :address, Post_code = :zip, City = :city 
		WHERE owner_id = :oid");
		$stmt_insertOwner->bindParam(':firstname', $firstName, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':lastname', $lastName, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':mail', $mail, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':phone', $phoneNumber, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':zip', $zip, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':city', $city, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':oid', $oid, PDO::PARAM_INT);
		$stmt_insertOwner->execute();
		

	}
	
	function updateCar($conn, $cid, $brand, $model, $yearmodel, $fueltype, $price, $milage, $license, $drivetrain, $engine, $transmission, $horsepower, $fuelconsumtion, $created, $image, $status ){
		
		$stmt_insertOwner = $conn->prepare("UPDATE table_cars 
		SET car_Brand = :brand, car_Model = :model, car_Year_model = :year, car_Price = :price, car_Milage = :milage, car_Licens_number = :license, car_Engine = :engine, car_Gearbox_fk = :gearbox, car_Horsepower = :horsepower, car_Fuel_consumtion = :fuelconsumption, car_created = :created, car_Img = :image, car_status_fk = :status, car_fueltype_fk = :fueltype, drivetrain_fk = :drivetrain
		WHERE car_id = :cid");
		$stmt_insertOwner->bindParam(':cid', $cid, PDO::PARAM_INT);
		$stmt_insertOwner->bindParam(':brand', $brand, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':model', $model, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':year', $yearmodel, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':fueltype', $fueltype, PDO::PARAM_INT);
		$stmt_insertOwner->bindParam(':price', $price, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':milage', $milage, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':license', $license, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':drivetrain', $drivetrain, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':engine', $engine, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':gearbox', $transmission, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':horsepower', $horsepower, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':fuelconsumption', $fuelconsumtion, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':created', $created, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':image', $image, PDO::PARAM_STR);
		$stmt_insertOwner->bindParam(':status', $status, PDO::PARAM_INT);
		$stmt_insertOwner->execute();
		
		return $cid;

	}
	
	function selectCars($conn, $amount){
		$selectedCars = $conn->prepare(
		'SELECT *
		FROM table_cars
		INNER JOIN table_owners
		ON table_cars.car_owner_fk = table_owners.owner_id 
		INNER JOIN transmission_table
		ON table_cars.car_Gearbox_fk = transmission_table.transmission_id 
		INNER JOIN drivetrain_table
		ON table_cars.drivetrain_fk = drivetrain_table.drivetrain_id 
		WHERE car_status_fk = 1
		LIMIT :amount'
		);
		$selectedCars->bindParam(':amount', $amount, PDO::PARAM_INT);
		$selectedCars->execute();
		return $selectedCars;
	}
	
	function selectSortedCars($conn, $amount, $sortCriteria, $direction){
		echo $sortCriteria;
		
		$sql_query = 'SELECT *
		FROM table_cars
		INNER JOIN table_owners
		ON table_cars.car_owner_fk = table_owners.owner_id 
		INNER JOIN transmission_table
		ON table_cars.car_gearbox_fk = transmission_table.transmission_id 
		WHERE car_status_fk = 1 
		ORDER BY ';
		
		if($sortCriteria == "car_Price"){
			$sql_query .= 'car_Price';
		}
		
		else if ($sortCriteria == "car_Milage"){
			$sql_query .= 'car_Milage';
		}
		
		if($direction == 1){
			$sql_query .= ' ASC';
		}
		
		else if($direction == 2){
			$sql_query .= ' DESC';
		}
		
		$sql_query .= " LIMIT :amount";
		
		//echo $sql_query;
		
		$selectedCars = $conn->prepare($sql_query);
		$selectedCars->bindParam(':amount', $amount, PDO::PARAM_INT);
		$selectedCars->execute();
		return $selectedCars;
	}
	
	function selectSingleCar($conn, $id){
		$selectedCar = $conn->prepare(
		'SELECT *
		FROM table_cars
		INNER JOIN table_owners
		ON table_cars.car_owner_fk = table_owners.owner_id 
		INNER JOIN transmission_table
		ON table_cars.car_gearbox_fk = transmission_table.transmission_id 
		WHERE table_cars.car_id = :id'
		);
		$selectedCar->bindParam(':id', $id, PDO::PARAM_INT);
		$selectedCar->execute();
		$carData = $selectedCar->fetch();
		
		return $carData;
	}
	
	
	
	function fetchTransmissions($conn){
		$selectedTransmissions = $conn->query("SELECT * FROM transmission_table");
		return $selectedTransmissions;
	}	
	
	function fetchFueltypes($conn){
		$selectedFueltypes = $conn->query("SELECT * FROM fueltype_table");
		return $selectedFueltypes;
	}

	function fetchDrivetrain($conn){
		$selectedDrivetrain = $conn->query("SELECT * FROM drivetrain_table");
		return $selectedDrivetrain;
	}

	function deleteCar($conn, $car){
		$deleteCarQuery = $conn->prepare("UPDATE table_cars SET car_status_fk = 3 WHERE car_id = :cid");
		$deleteCarQuery->bindParam(':cid', $car, PDO::PARAM_INT);
		$deleteCarQuery->execute();
		return true;
	}
	
	function selectAllBrands($conn){
		$allCarBrands = $conn->query("SELECT DISTINCT car_Brand FROM table_cars;");
		return $allCarBrands;
	}
	
	function selectAllTransmissionTypes($conn){
		$allTransmissionTypes = $conn->query("SELECT * FROM transmission_table;");
		return $allTransmissionTypes;
	}
		
	function selectFilteredCars($conn, $filterCriteria, $column){
		$sql_query = 'SELECT *
		FROM table_cars
		INNER JOIN table_owners
		ON table_cars.car_owner_fk = table_owners.owner_id 
		INNER JOIN transmission_table
		ON table_cars.car_Gearbox_fk = transmission_table.transmission_id 
		WHERE ';
		
		if($column == "car_Brand")
		$sql_query .= "car_Brand";
	
		else {
			$sql_query .= "car_Gearbox_fk";
		}
		
		$sql_query .= " = :filter";
		
		
		$selectedCars = $conn->prepare($sql_query);
		$selectedCars->bindParam(':filter', $filterCriteria, PDO::PARAM_STR);
		$selectedCars->execute();
		
		return $selectedCars;
	}
?>