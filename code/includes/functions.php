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

function fetchCategories($conn){
	$selectedCategories = $conn->query("SELECT * FROM category_table");
	return $selectedCategories;
}

function fetchillustrators($conn){
	$selectedIllustrators = $conn->query("SELECT * FROM illustrator_table");
	return $selectedIllustrators;
}

function selectAllBooks($conn){
	$allBooks = $conn->query("SELECT * FROM book_table");
	return $allBooks;
}

function selectBooks($conn, $amount){
	$selectedBooks = $conn->prepare(
	'SELECT *
	FROM book_table
	INNER JOIN agerec_table
	ON book_table.book_agerec_fk = agerec_table.agerec_id 
	INNER JOIN author_table
	ON book_table.book_author_fk = author_table.author_id 
	INNER JOIN lang_table
	ON book_table.book_lang_fk = lang_table.lang_id
	INNER JOIN publish_table
	ON book_table.book_publish_fk = publish_table.publish_id
	INNER JOIN category_table
	ON book_table.book_category_fk = category_table.category_id
	INNER JOIN genre_table
	ON book_table.book_genre_fk = genre_table.genre_id 
	WHERE book_status_fk = 1
	LIMIT :amount'
	);
	$selectedBooks->bindParam(':amount', $amount, PDO::PARAM_INT);
	$selectedBooks->execute();
	return $selectedBooks;
}




?>