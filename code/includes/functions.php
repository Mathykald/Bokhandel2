<?php

?>
<?php

if (!function_exists('cleanInput')) {
function cleanInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
}




if (!function_exists('createAuthor')) {
    function createAuthor($conn, $author_firstname) {
	
	$stmt_insertAuthor = $conn->prepare("INSERT INTO author_table (author_firstname, author_lastname) VALUES (:author_firstname, :author_lastname)");
	$stmt_insertAuthor->bindParam(':author_firstname', $author_firstname, PDO::PARAM_STR);
	$stmt_insertAuthor->execute();
	
	$insertedAuthorId = $conn->lastInsertId();
	return $insertedAuthorId;
}
}
if (!function_exists('createPublish')) {
function createPublish($conn, $publish_name ){
	
	$stmt_insertPublish = $conn->prepare("INSERT INTO publish_table (publish_name) VALUES (:publish_name)");
	$stmt_insertPublish->bindParam(':publish_name', $publish_name, PDO::PARAM_STR);
	$stmt_insertPublish->execute();
	
	$insertedPublishId = $conn->lastInsertId();
	return $insertedPublishId;
}
}
if (!function_exists('createBook')) {
	function createBook($conn, $book_title, $book_price, $book_rating, $book_author, $book_illustrator, $book_description, $book_genre, $book_pages, $book_img, $book_language, $book_agerec, $book_publish, $book_category, $release_date, $status_name, $uid){
		$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
		$stmt_insertBook = $conn->prepare("INSERT INTO book_table (book_title, book_price, book_rating, book_author_fk, book_illustrator_fk, book_description, 
		book_genre_fk, book_pages, book_img, book_lang_fk, 
		book_agerec_fk, book_publish_fk, book_category_fk, 
		release_date, book_status_fk, book_user_fk)
		VALUES (:book_title, :book_price, :book_rating, :book_author, :book_illustrator, :book_description, 
		:book_genre, :book_pages, :book_img, :book_language, 
		:book_agerec, :book_publish, :book_category, 
		:release_date, :status_name, :uid )");
		$stmt_insertBook->bindParam(':book_title', $book_title, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_price', $book_price, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_rating', $book_rating, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_author', $book_author, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_illustrator', $book_illustrator, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_description', $book_description, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_genre', $book_genre, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_pages', $book_pages, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_img', $book_img, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_language', $book_language, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_agerec', $book_agerec, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_publish', $book_publish, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':book_category', $book_category, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':release_date', $release_date, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':status_name', $status_name, PDO::PARAM_STR);
		$stmt_insertBook->bindParam(':uid', $uid, PDO::PARAM_STR);
		$stmt_insertBook->execute();
	}
}


if (!function_exists('updateBook')) {
    function updateBook($conn, $bid, $book_title, $book_price, 
                        $book_rating, $book_author, $book_illustrator, $book_description, 
                        $book_genre, $book_pages, $book_img, $book_language, $book_agerec, 
                        $book_publish, $book_category, $release_date, $status_name ){



        $stmt_insertBook = $conn->prepare("UPDATE book_table SET 
            book_title = :book_title, 
            book_price = :book_price, 
            book_rating = :book_rating, 
            book_author_fk = :book_author, 
            book_illustrator_fk = :book_illustrator, 
            book_description = :book_description, 
            book_genre_fk = :book_genre, 
            book_pages = :book_pages, 
            book_img = :book_img, 
            book_lang_fk = :book_language, 
            book_agerec_fk = :book_agerec, 
            book_publish_fk = :book_publish, 
            book_category_fk = :book_category,
            release_date = :release_date, 
            book_status_fk = :status_name 
            WHERE book_id = :bid");

								
        $stmt_insertBook->bindParam(':bid', $bid, PDO::PARAM_INT);
        $stmt_insertBook->bindParam(':book_title', $book_title, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_price', $book_price, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_rating', $book_rating, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_author', $book_author, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_illustrator', $book_illustrator, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_description', $book_description, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_genre', $book_genre, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_pages', $book_pages, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_img', $book_img, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_language', $book_language, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_agerec', $book_agerec, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_publish', $book_publish, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':book_category', $book_category, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':release_date', $release_date, PDO::PARAM_STR);
        $stmt_insertBook->bindParam(':status_name', $status_name, PDO::PARAM_STR);
        $stmt_insertBook->execute();

        return $bid;
    }
}

if (!function_exists('createIllustrator')) {
	function createIllustrator($conn, $illustrator_firstname, $illustrator_lastname ){
	
		$stmt_insertIllustrator = $conn->prepare("INSERT INTO illustrator_table (illustrator_firstname, illustrator_lastname) VALUES (:illustrator_firstname, :illustrator_lastname)");
		$stmt_insertIllustrator->bindParam(':illustrator_firstname', $illustrator_firstname, PDO::PARAM_STR);
		$stmt_insertIllustrator->bindParam(':illustrator_lastname', $illustrator_lastname, PDO::PARAM_STR);
		$stmt_insertIllustrator->execute();
	
		$insertedIllustratorId = $conn->lastInsertId();
		return $insertedIllustratorId;
	}
}

if (!function_exists('selectFilteredBooks')) {
function selectFilteredBooks($conn, $languageId, $categoryId, $genreId){
    $addedToQuery = false;
    $query = 'SELECT *
              FROM book_table AS b
              INNER JOIN lang_table AS l ON b.book_lang_fk = l.lang_id
              INNER JOIN category_table AS c ON b.book_category_fk = c.category_id
              INNER JOIN genre_table AS g ON b.book_genre_fk = g.genre_id
              WHERE ';

    if ($languageId != 0 && $addedToQuery == true) {
        $query .= 'AND l.lang_id = :languageId';
    }
    else if ($languageId != 0 && $addedToQuery == false) {
        $query .= 'l.lang_id = :languageId';
        $addedToQuery = true;
    }

    if ($categoryId != 0 && $addedToQuery == true) {
        $query .= ' AND c.category_id = :categoryId';
    }
    else if ($categoryId != 0 && $addedToQuery == false) {
        $query .= 'c.category_id = :categoryId';
        $addedToQuery = true;
    }

    if ($genreId != 0 && $addedToQuery == true) {
        $query .= ' AND g.genre_id = :genreId';
    }
    else if ($genreId != 0 && $addedToQuery == false) {
        $query .= 'g.genre_id = :genreId';
        $addedToQuery = true;
    }

    $stmt = $conn->prepare($query);

    if ($languageId != 0) {
        $stmt->bindParam(':languageId', $languageId, PDO::PARAM_INT);
    }

    if ($categoryId != 0) {
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
    }

    if ($genreId != 0) {
        $stmt->bindParam(':genreId', $genreId, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    }

    if (!function_exists('selectSortedBooks')) {
        function selectSortedBooks($conn, $sortCriteria, $direction) {
            $sql_query = 'SELECT *
                FROM book_table
                INNER JOIN lang_table ON book_table.book_lang_fk = lang_table.lang_id
                INNER JOIN agerec_table ON book_table.book_agerec_fk = agerec_table.agerec_id 
                INNER JOIN author_table ON book_table.book_author_fk = author_table.author_id 
                INNER JOIN publish_table ON book_table.book_publish_fk = publish_table.publish_id
                INNER JOIN category_table ON book_table.book_category_fk = category_table.category_id
                INNER JOIN genre_table ON book_table.book_genre_fk = genre_table.genre_id 
                WHERE book_status_fk = 1';
    
                // Add condition for the current month
                if ($currentMonthOnly) {
                    $sql_query .= " AND MONTH(book_table.release_date) = MONTH(CURRENT_DATE()) AND YEAR(book_table.release_date) = YEAR(CURRENT_DATE())";
                }

                if ($sortCriteria == "book_price" || $sortCriteria == "book_pages") {
                    $sql_query .= " ORDER BY $sortCriteria";
                
                    // Append the sorting direction
                    if ($direction == 2) {
                        $sql_query .= ' DESC';
                    } elseif ($direction == 1) {
                        $sql_query .= ' ASC';
                    }
                }
    
        
    
            // Prepare the statement
            $stmt = $conn->prepare($sql_query);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    
if (!function_exists('createCategory')) {
	function createCategory($conn, $category_name){
		
		$stmt_insertCategory = $conn->prepare("INSERT INTO category_table (category_name) VALUES (:category_name)");
		$stmt_insertCategory->bindParam(':category_name', $category_name, PDO::PARAM_STR);
		$stmt_insertCategory->execute();
		
		$insertCategoryId = $conn->lastInsertId();
		return $insertCategoryId;
	}
}
if (!function_exists('fetchAuthors')) {
	function fetchAuthors($conn){
		$selectedAuthors = $conn->query("SELECT * FROM author_table");
		return $selectedAuthors;
	}
}
if (!function_exists('fetchCreator')) {
	function fetchCreator($conn){
		$selectedAuthors = $conn->query("SELECT * FROM user_table");
		return $selectedAuthors;
	}
}
if (!function_exists('fetchCategories')) {
	function fetchCategories($conn){
		$selectedCategories = $conn->query("SELECT * FROM category_table");
		return $selectedCategories;
	}
}
if (!function_exists('fetchillustrators')) {
	function fetchillustrators($conn){
		$selectedIllustrators = $conn->query("SELECT * FROM illustrator_table");
		return $selectedIllustrators;
	}
}
if (!function_exists('fetchagerec')) {
	function fetchagerec($conn){
		$selectedagerec = $conn->query("SELECT * FROM agerec_table");
		return $selectedagerec;
	}
}
if (!function_exists('fetchlanguages')) {
	function fetchlanguages($conn){
		$selectedlanguage = $conn->query("SELECT * FROM lang_table");
		return $selectedlanguage;
	}
}
if (!function_exists('fetchpublishes')) {
	function fetchpublishes($conn){
		$selectedpublish = $conn->query("SELECT * FROM publish_table");
		return $selectedpublish;
	}
}
if (!function_exists('fetchgenre')) {
	function fetchgenre($conn){
		$selectedgenre = $conn->query("SELECT * FROM genre_table");
		return $selectedgenre;
	}
}
if (!function_exists('fetchusers')) {
	function fetchusers($conn){
		$selecteduser = $conn->query("SELECT * FROM user_table");
		return $selectedusser;
	}
}
if (!function_exists('selectAllBooks')) {
	function selectAllBooks($conn){
		$allBooks = $conn->query("SELECT DISTINCT book_genre_fk FROM book_table");
		return $allBooks;
	}
}

if (!function_exists('selectBooks')) {
    function selectBooks($conn)
    {
        // Assuming you have a session variable 'uid' to use in the query
        $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

        $sql = 'SELECT *
                FROM book_table
                INNER JOIN agerec_table ON book_table.book_agerec_fk = agerec_table.agerec_id 
                INNER JOIN author_table ON book_table.book_author_fk = author_table.author_id 
                INNER JOIN lang_table ON book_table.book_lang_fk = lang_table.lang_id
                INNER JOIN publish_table ON book_table.book_publish_fk = publish_table.publish_id
                INNER JOIN category_table ON book_table.book_category_fk = category_table.category_id
                INNER JOIN genre_table ON book_table.book_genre_fk = genre_table.genre_id 
                INNER JOIN user_table ON book_table.book_user_fk = user_table.u_ID
                WHERE book_status_fk = 1 
                AND user_table.u_ID = :uid';

        $selectedBooks = $conn->prepare($sql);
        $selectedBooks->bindParam(':uid', $uid, PDO::PARAM_INT);
        $selectedBooks->execute();

        return $selectedBooks;
    }
}

if (!function_exists('everyBook')) {
    function everyBook($conn)
    {
        // Assuming you have a session variable 'uid' to use in the query

        $sql = 'SELECT *
                FROM book_table
                INNER JOIN agerec_table ON book_table.book_agerec_fk = agerec_table.agerec_id 
                INNER JOIN author_table ON book_table.book_author_fk = author_table.author_id 
                INNER JOIN lang_table ON book_table.book_lang_fk = lang_table.lang_id
                INNER JOIN publish_table ON book_table.book_publish_fk = publish_table.publish_id
                INNER JOIN category_table ON book_table.book_category_fk = category_table.category_id
                INNER JOIN genre_table ON book_table.book_genre_fk = genre_table.genre_id 
                WHERE book_status_fk = 1 ';

        $everyBook = $conn->prepare($sql);
        $everyBook->execute();

        return $everyBook;
    }
}

if (!function_exists('newBooks')) {
    function newBooks($conn, $currentMonthOnly = false)
    {

        $sql = 'SELECT *
                FROM book_table
                INNER JOIN agerec_table ON book_table.book_agerec_fk = agerec_table.agerec_id 
                INNER JOIN author_table ON book_table.book_author_fk = author_table.author_id 
                INNER JOIN lang_table ON book_table.book_lang_fk = lang_table.lang_id
                INNER JOIN publish_table ON book_table.book_publish_fk = publish_table.publish_id
                INNER JOIN category_table ON book_table.book_category_fk = category_table.category_id
                INNER JOIN genre_table ON book_table.book_genre_fk = genre_table.genre_id 
                WHERE book_status_fk = 1 ';

        if ($currentMonthOnly) {
            $sql .= " AND MONTH(book_table.release_date) = MONTH(CURRENT_DATE()) AND YEAR(book_table.release_date) = YEAR(CURRENT_DATE())";
        }
        $everyBook = $conn->prepare($sql);
        $everyBook->execute();

        return $everyBook;
    }
}



if (!function_exists('deleteBook')) {
function deleteBook($conn, $book){
	$deleteBookQuery = $conn->prepare("UPDATE book_table SET book_status_fk = 3 WHERE book_id = :bid");
	$deleteBookQuery->bindParam(':bid', $book, PDO::PARAM_INT);
	$deleteBookQuery->execute();
	return true;
}
}

if (!function_exists('selectSingleBook')) {
    function selectSingleBook($conn, $id) {
        $selectedBook = $conn->prepare(
            'SELECT *
            FROM book_table AS b
            INNER JOIN agerec_table AS a ON b.book_agerec_fk = a.agerec_id 
            INNER JOIN author_table AS author ON b.book_author_fk = author.author_id 
            INNER JOIN illustrator_table AS illustrator ON b.book_illustrator_fk = illustrator.illustrator_id 
            INNER JOIN lang_table AS l ON b.book_lang_fk = l.lang_id
            INNER JOIN publish_table AS p ON b.book_publish_fk = p.publish_id
            INNER JOIN category_table AS c ON b.book_category_fk = c.category_id
            INNER JOIN genre_table AS g ON b.book_genre_fk = g.genre_id
            INNER JOIN status_table AS s ON b.book_status_fk = s.status_id
            WHERE b.book_status_fk = 1 AND b.book_id = :id'
        );	

        $selectedBook->bindParam(':id', $id, PDO::PARAM_INT);
        $selectedBook->execute();
        $bookData = $selectedBook->fetch(PDO::FETCH_ASSOC);

        return $bookData;
    }
}
?>

