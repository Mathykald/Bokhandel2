<?php
// Include your config file to get the $conn connection
include "includes/config.php";

// Get the search term from the request
$q = $_GET["q"];

// Initialize an empty hint
$hint = "";

// Lookup in the database if the search term is not empty
if (strlen($q) > 0) {
    try {
        // Prepare a SQL query
        $stmt = $conn->prepare("SELECT book_id, book_title, author_firstname, author_lastname, 
        publish_name, illustrator_firstname, illustrator_lastname, lang_language, book_price,
        book_pages, book_description, book_img, book_rating
        FROM book_table 
        INNER JOIN author_table ON book_table.book_author_fk = author_table.author_id 
        INNER JOIN publish_table ON book_table.book_publish_fk = publish_table.publish_id 
        INNER JOIN illustrator_table ON book_table.book_illustrator_fk = illustrator_table.illustrator_id 
        INNER JOIN lang_table ON book_table.book_lang_fk = lang_table.lang_id
        WHERE book_title LIKE :searchTerm 
        OR author_firstname LIKE :searchTerm 
        OR author_lastname LIKE :searchTerm 
        OR publish_name LIKE :searchTerm 
        OR illustrator_firstname LIKE :searchTerm 
        OR illustrator_lastname LIKE :searchTerm 
        OR lang_language LIKE :searchTerm 
        LIMIT 15");
        $stmt->bindValue(':searchTerm', '%' . $q . '%', PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Loop through the results
echo "<div class='row'>";
foreach ($results as $result) {
    // Check if 'book_title' key exists
    if (isset($result['book_title'])) {
        // Get the book title and author
        $bookTitle = $result['book_title'];
        $bookAuthorfirstname = $result['author_firstname'];
        $bookAuthorlastname = $result['author_lastname'];
        $book_price = $result['book_price'];
        $book_pages = $result['book_pages'];
        $book_description = $result['book_description'];
        // Check if 'book_id' key exists
        $bookId = isset($result['book_id']) ? $result['book_id'] : null;
        // Build the hint with a link to the book page
        $hint .= "<div id='bksomelese2' class='card m-3 col-sm-2'>
        <img src='uploads/{$result['book_img']}' class='card-img-top' alt='...'>
        <div class='card-body'>
        <a id='livesearchthings' href='single_Book.php?bookID=$bookId'>
        <h5 class='card-title'>$bookTitle</h5>
        <p class='card-text'></p>
        </div>
        <p>Författare: {$result['author_firstname']} {$result['author_lastname']}</p>
        <p>Pris: {$result['book_price']}€</p>
        <p>Sidor: {$result['book_pages']}</p>
        <p>Rating: {$result['book_rating']}/5</p>
        </div>";
    }
}

    } catch (PDOException $e) {
        // Handle the exception (log or display an error message)
        $hint = "Error: " . $e->getMessage();
    }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint == "") {
    $response = "no suggestion";
} else {
    $response = $hint;
}

// Output the response
echo $response;
?>
