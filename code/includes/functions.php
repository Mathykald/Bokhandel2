<?php
	
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<?php

function createAuthor($conn, $author_firstname, $author_lastname ){
	
	$stmt_insertAuthor = $conn->prepare("INSERT INTO author_table (author_firstname, author_lastname) VALUES (:author_firstname, :author_lastname)");
	$stmt_insertAuthor->bindParam(':author_firstname', $author_firstname, PDO::PARAM_STR);
	$stmt_insertAuthor->bindParam(':author_lastname', $author_lastname, PDO::PARAM_STR);
	$stmt_insertAuthor->execute();
	
	$insertedAuthorId = $conn->lastInsertId();
	return $insertedAuthorId;
}

function createIllustrator($conn, $illustrator_firstname, $illustrator_lastname ){
	
	$stmt_insertIllustrator = $conn->prepare("INSERT INTO illustrator_table (illustrator_firstname, illustrator_lastname) VALUES (:illustrator_firstname, :illustrator_lastname)");
	$stmt_insertIllustrator->bindParam(':illustrator_firstname', $illustrator_firstname, PDO::PARAM_STR);
	$stmt_insertIllustrator->bindParam(':illustrator_lastname', $illustrator_lastname, PDO::PARAM_STR);
	$stmt_insertIllustrator->execute();
	
	$insertedIllustratorId = $conn->lastInsertId();
	return $insertedIllustratorId;
}

function createCategory($conn, $category_name){
	
	$stmt_insertCategory = $conn->prepare("INSERT INTO category_table (category_name) VALUES (:category_name)");
	$stmt_insertCategory->bindParam(':category_name', $category_name, PDO::PARAM_STR);
	$stmt_insertCategory->execute();
	
	$insertCategoryId = $conn->lastInsertId();
	return $insertCategoryId;
}


function fetchAuthors($conn){
	$selectedAuthors = $conn->query("SELECT * FROM author_table");
	return $selectedAuthors;
}


?>