
<?php
	include 'header.php';
?>

<div class="bc">
<h2 class="my-5">All böcker</h2>
<?php
$allBooks = selectAllBooks($conn);

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


	// form för sök fält
    echo "<form method='POST' action=''>";
        echo "<h4 class='mt-3' for='searchinput'>Sök efter bok</h4>";
        echo "<input class='mb-3' style='width: 250px; height: 32px;' type='text' onkeyup='showResult(this.value)' id='searchinput' name='search_bookname' placeholder='Ange titel, författare osv...'>";
	    echo "<div id='livesearch2'></div>";
    echo "</form>";

	
	echo "<div class='container'>";
	echo "<div class='row'>";


    foreach ($displayBooks as $row){

    echo "
	<div id='bksomelese'class='card m-2 col-sm-2'>
		<img src='uploads/{$row['book_img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
		<h5 class'card-title'>{$row['book_title']}</h5><br>
		<p>Pris: {$row['book_price']}€</p>
		<p class='card-text'>Sidor: {$row['book_pages']}<p>
		<a class='tingeling mb-3' href='single_Book.php?bookID={$row['book_id']}'>Se all info</a>";
		 
			if($user->checkLoginStatus()){
			if($user->checkUserRole(50)){
		echo "<a class='tingeling mb-3'href='edit_book.php?bookID={$row['book_id']}'>Edit book</a>";
			}
			}
		echo "</div>";
		echo "</div>";
}
echo "</div>";
echo "</div>";


?>	
?>
    <!-- Filter -->
    <div class="sidebar pt-3 col-sm-4 bg-light">
	<div class="sidebar pt-3 col-sm-4 bg-light">
    <form action="" method="GET" id="filterform">
    
        <label for="filterlanguage">Filtrera med language:</label>
        	<select name="filterlanguage" id="filterlanguage">
    	        <option value="0">Choose..</option>
	                <?php
                    // språk tas från databasen med fetchlanguages funktion
                        $allBooks = fetchlanguages($conn);
				        foreach($allBooks as $row){
						    echo "<option value='{$row['lang_id']}'>{$row['lang_language']}</option>";
                        }
                    ?>
	        </select><br>
         
        <label for="filtercateogry">Filtrera med Kategori</label>
			<select name="filtercateogry" id="filtercateogry">
				<option value="0">Choose..</option>
                	<?php
                    // Kategorier tas från databasen med fetchCategories funktion
            	        $allBooks = fetchCategories($conn);
				        foreach($allBooks as $row){
						    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
						}
                    ?>
			</select><br>

		<label for="filtergenre">Filtrera med genre</label>
			<select name="filtergenre" id="filtergenre">
				<option value="0">Choose..</option>
	                <?php
                    // Genre tas från databasen med fetchgenre funktion
	                    $allBooks = fetchgenre($conn);
	                    foreach ($allBooks as $row){
			                echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
	                   }
                    ?>
		    </select> <br>
            <!-- submit knapp för att filtrera böckerna -->
			<input id="filter" type="submit" name="filter-submit" value="Filter"><br>
	</form><br>

	






<!-- Formen för att sortera böckerna -->
	<form action="" method="GET" id="sortform">
		<label for="sortprice">Sortera Pris:</label>
        <select name="sortprice" id="sortprice">
        	<option value="0">Choose..</option>
        	<option value="1">Billigaste-Dyrast</option>
          	<option value="2">Dyraste-Billigast</option>
    	</select> <br>
        <label for="sortpages">Sortera Sidantal:</label>
        <select name="sortpages" id="sortpages">
            <option value="0">Choose..</option>
            <option value="1">Lägsta sidantal</option>
            <option value="2">Högsta sidantal</option>
        </select>
        <!-- submit knapp för att sortera böckerna -->
		<input id="Sort" type="submit" name="sort-submit" value="Sort"><br>

	</form>
</div>

</div>

<?php include 'footer.php';?>