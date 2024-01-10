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
        $stmt = $conn->prepare("SELECT book_title FROM book_table WHERE book_title LIKE :searchTerm LIMIT 5");
        $stmt->bindValue(':searchTerm', '%' . $q . '%', PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop through the results
        foreach ($results as $result) {
            // Build the hint
            $hint .= "<a href='#'>" . $result['Name'] . "</a><br>";
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
