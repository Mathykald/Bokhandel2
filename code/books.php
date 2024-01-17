
<?php
	include 'header.php';
?>

<div class="bc">
<h2 class="my-5">All böcker</h2>
<?php
$allBooks = selectAllBooks($conn);

if(isset($_GET['sortprice']) && $_GET['sortprice'] != 0){
	$sortCriteria = 'book_price';
	$sortDirection = cleanInput($_GET['sortprice']);
	$selectedBooks = selectSortedBooks($conn, $sortCriteria, $sortDirection);
}

else if(isset($_GET['sortpages']) && $_GET['sortpages'] != 0){
	$sortCriteria = 'book_pages';
	$sortDirection = cleanInput($_GET['sortpages']);
	$selectedBooks = selectSortedBooks($conn, $sortCriteria, $sortDirection);
}

$displayBooks = !empty($filteredBooks) ? $filteredBooks : everyBook($conn);

if (isset($_GET['filter-submit'])) {
    $languageId = $_GET['filterlanguage'];
    $categoryId = $_GET['filtercateogry'];
    $genreId = $_GET['filtergenre'];

    $filteredBooks = selectFilteredBooks($conn, $languageId, $categoryId, $genreId);
}

else {
	$displayBooks = everyBook($conn);
	}
	echo "<div class='container'>";
	echo "<div class='row'>";


    foreach ($displayBooks as $row){

    echo "
	<div id='bksomelese'class='card m-2 col-sm-2'>
		<img src='uploads/{$row['book_img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
		<h5 class'card-title'>{$row['book_title']}</h5>
			<p class='card-text'><p>
		</div>
			<p>{$row['book_description']}</p>
            <p>{$row['book_price']}€</p>
            <p>Sidor: {$row['book_pages']}</p>
			 <a href='single_Book.php?bookID={$row['book_id']}'>Se all info</a>
		</div>
		";
}
echo "</div>";
echo "</div>";

?>

<div class="sidebar pt-3 col-sm-4 bg-light">
	<div class="sidebar pt-3 col-sm-4 bg-light">
    <form action="" method="GET" id="filterform">
    
        <label for="filterlanguage">Filtrera med language:</label>
        	<select name="filterlanguage" id="filterlanguage">
    	        <option value="0">Choose..</option>
	                <?php
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
	                    $allBooks = fetchgenre($conn);
	                    foreach ($allBooks as $row){
			                echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
	                   }
                    ?>
		    </select> <br>
			<input id="filter2" type="submit" name="filter-submit" value="Filter"><br>
	</form><br>

	







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
		<input id="Sort" type="submit" name="sort-submit" value="Sort"><br>

	</form>
</div>

</div>

<?php include 'footer.php';?>