
<?php
	include 'header.php';

// Checka om formen för sortering är skickad
if (isset($_GET['sort-submit'])) {
    // Få sortering criteria från formen
    $sortPrice = $_GET['sortprice'];
    $sortPages = $_GET['sortpages'];

    // Checka om sortering crietria är valid
    if (($sortPrice == 1 || $sortPrice == 2) && ($sortPages == 1 || $sortPages == 2)) {
        // Call selectSortedBooks function
        $sortedBooks = selectSortedBooks($conn, $sortPrice, $sortPages, true);
    } else {
        // Tar hand om invalid values eller visar ett error meddelande
        echo "Invalid sorting criteria or direction.";
    }
}

// Checka om formen för filtrering är skickad
if (isset($_GET['filter-submit'])) {
    // Få filter criteria från form
    $languageId = $_GET['filterlanguage'];
    $categoryId = $_GET['filtercateogry'];
    $genreId = $_GET['filtergenre'];

    // Call funktioner selectFilteredBooks funktion
    $filteredBooks = selectFilteredBooks($conn, $languageId, $categoryId, $genreId);
}

?>

<div class="bc">

<script>
// JavaScript funktion för live search
function showResult(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET", "livesearch.php?q=" + str, true);
    xmlhttp.send();
}
</script>


<?php
// Checka om sök formen har blivit skickad
if (isset($_POST['searchbook_submit'])) {
    // Call searchBooks method
    $bookList = $user->searchBooks();
}

// Display böcker baserat på filter eller visa alla böcker
$displayBooks = !empty($filteredBooks) ? $filteredBooks : everyBook($conn);

// Call method för nya böcker
$newBooks = newBooks($conn, true);

$everyBook = everybook($conn);

// form för sök fält
    echo "<form method='POST' action=''>";
        echo "<h4 class='mt-3' for='searchinput'>Sök efter bok</h4>";
        echo "<input class='mb-3' style='width: 250px; height: 32px;' type='text' onkeyup='showResult(this.value)' id='searchinput' name='search_bookname' placeholder='Ange titel, författare osv...'>";
	    echo "<div id='livesearch'></div>";
    echo "</form>";
// Populära kategorier cards
// första
    echo "<div class='container'>";
        echo "<h3>Populära kategorier</h3>";
        echo "<div class='row'>";
            echo "<div class='card m-3 col-sm-2 bksomelese3'>";
                echo "<a class='tingeling' href=''><img src='images/open-book-with-characters.jpg']}' class='card-img-top' alt='Bok pärmbild'>";
            echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Action</h5></a>";
                echo "<p class='card-text'></p>";
            echo "</div>";
            echo "</div>";
// Andra
            echo "<div class='card m-3 col-sm-2 bksomelese3'>";
                echo "<a class='tingeling' href=''><img src='images/darkness-night-with-skull-high-view.jpg']}' class='card-img-top' alt='Bok pärmbild'>";
            echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Horror</h5></a>";
                echo "<p class='card-text'></p>";
            echo "</div>";
            echo "</div>";
// Tredje    
            echo "<div class='card m-3 col-sm-2 bksomelese3'>";
                echo "<a class='tingeling' href=''><img src='images/open-book-mock-up-with-roses-skull.jpg']}' class='card-img-top' alt='Bok pärmbild'>";
            echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Thriller</h5></a>";
                echo "<p class='card-text'></p>";
        echo "</div>";
        echo "</div>";
// Fjärde
        echo "<div class='card m-3 col-sm-2 bksomelese3'>";
            echo "<a class='tingeling' href=''><img src='images/6621088.jpg']}' class='card-img-top' alt='Bok pärmbild'>";
        echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Romans</h5></a>";
            echo "<p class='card-text'></p>";
        echo "</div>";
        echo "</div>";
// Femte
            echo "<div class='card m-3 col-sm-2 bksomelese3'>";
                echo "<a class='tingeling' href=''><img src='images/06.jpg' ]}' class='card-img-top' alt='Bok pärmbild'>";
            echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Tecknat</h5></a>";
                echo "<p class='card-text'></p>";
            echo "</div>";
            echo "</div>";
        echo "</div>";
// Nya böcker cards
        echo "<h3>Nya böcker</h3>";
        echo "<div class='row'>";
        // Loopas ut från databasen med foreach
            foreach ($newBooks as $row) {
                echo "<div id='bksomelese' class='card m-3 col-sm-2'>";
                    echo "<a class='tingeling' href='single_Book.php?bookID={$row['book_id']}'><img src='uploads/{$row['book_img']}' class='card-img-top' alt='Bok pärmbild'>";
                    echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>{$row['book_title']}</h5></a>";
                        echo "<p class='card-text'></p>";
                    echo "</div>";
                    echo "<p>{$row['book_price']}€</p>";
                    echo "<p>Sidor: {$row['book_pages']}</p>";
                    echo "<a class='tingeling mb-3' href='single_Book.php?bookID={$row['book_id']}'>View full info</a>";
                echo "</div>";
            }
// error meddelande om det inte finns böcker skapade denna månad
    if (empty($newBooks)) {
        echo "<p>No matching books found.</p>";
    }

	echo "</div>";
// Utvalda böcker cards
    echo "<h3>Utvalda böcker</h3>";
	echo "<div class='row'>";
    // Loopas ut från databasen med foreach
    foreach ($everyBook as $row) {
        echo "<div id='bksomelese' class='card m-3 col-sm-2'>";
        echo "<a class='tingeling' href='single_Book.php?bookID={$row['book_id']}'><img src='uploads/{$row['book_img']}' class='card-img-top' alt='Bok pärmbild'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$row['book_title']}</h5></a>";
        echo "<p class='card-text'></p>";
        echo "</div>";
        echo "<p>{$row['book_description']}</p>";
        echo "<p>{$row['book_price']}€</p>";
        echo "<p>Sidor: {$row['book_pages']}</p>";
        echo "<a class='tingeling mb-3' href='single_Book.php?bookID={$row['book_id']}'>View full info</a>";
        echo "</div>";
    }
// Error meddelande ifall det inte finns böcker
    if (empty($featuredBooks)) {
        echo "<p>No matching books found.</p>";
    }

	echo "</div>";
    echo "</div>";
    echo "<div>";
// Vi är bäst sektion
    echo "<div id='wearebest'>";
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-6'>";
    echo "<img id='pfppic' src='images/60111.jpg' alt='Bild på företages logo'>";
    echo "</div>";
    echo "<div class='col-6'>";
    echo "<h4>Vi är bäst</h4>";
    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
// Kontaktuppgifter sektion
    echo "<div id='contactinfo' class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-6'>";
    echo "<h3>Kontaktuppgifter</h3>";
    echo "<p>Telefon: 040 2587932</p>";
    echo "<p>E-post: Bokhandel@gmail.com</p>";
    echo "<p>Adress: Bokhandelvägen 17</p>";
    echo "</div>";
    echo "<div class='col-6'>";
    echo "<img id='pfppic' src='images/221350-P1JPTN-142.jpg' alt='Bild på företages logo'>";
    echo "</div>";
    echo "</div>";
?>
   
    </div>
</div>


</head>
<body>

<?php include 'footer.php'; ?>