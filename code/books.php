
<?php
	include 'header.php';
?>

<div class="bc">
	<a href="login/index.php">Login</a>
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

else {
	$selectedBooks = selectBooks($conn);
	}

	echo "<div class='row'>";


    foreach ($selectedBooks as $row){

    echo "
	<div id='bksomelese'class='card m-3 col-sm-3'>
		<img src='uploads/{$row['book_img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
		<h5 class'card-title'>{$row['book_title']}</h5>
			<p class='card-text'><p>
		</div>
			<p>{$row['book_description']}</p>
            <p>{$row['book_price']}€</p>
            <p>Sidor: {$row['book_pages']}</p>
			 <a href='single_Book.php?bookID={$row['book_id']}'>View full info</a> <a href='edit_book.php?bookID={$row['book_id']}'>Edit book info</a>
			 <a href='deletebook.php?bookID={$row['book_id']}'>Delete book</a>
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
			<option value="1">Billigaste-Dyrast</option>
			<option value="2">Dyraste-Billigast</option>
		</select> <br>
		<label for="sortpages">Sort by pages:</label>
		<select name="sortpages" id="sortpages" onchange="submitSortForm()">
			<option value="0">Choose..</option>
			<option value="1">Lägsta sidantal</option>
			<option value="2">Högsta sidantal</option>
		</select> <br>
	</form>
	<form action="" method="GET" id="filterform">
		
    <form action="books.php" method="get">
    <label for="sortCriteria">Sort by:</label>
    <select name="sortCriteria" id="sortCriteria">
        <option value="book_price">Price</option>
        <option value="book_pages">Pages</option>
        <option value="lang_language">Language</option>
        <option value="genre_name">Genre</option>
    </select>

    <label for="direction">Sort direction:</label>
    <select name="direction" id="direction">
        <option value="1">Ascending</option>
        <option value="2">Descending</option>
    </select>

    <input type="submit" value="Sort">
</form>

                <label for="filterlanguage">Filtrera med language:</label>
                    <select name="filterlanguage" id="filterlanguage" onchange="submitFilterForm()">
                    <option value="0">Choose..</option>
                        <?php
                            $allBooks = fetchlanguages($conn);
					        foreach($allBooks as $row){
						    echo "<option value='{$row['lang_id']}'>{$row['lang_language']}</option>";
                            }
                        ?>
			        </select><br>
            
				<label for="filtergenre">Filtrera med genre</label>
					<select name="filtergenre" id="filtergenre" onchange="submitFilterForm()">
					<option value="0">Choose..</option>
                        <?php
		                    $allBooks = fetchgenre($conn);
		                    foreach ($allBooks as $row){
			                echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
		                    }
	                    ?>
				    </select> <br>

                <label for="filtergenre">Filtrera med Kategori</label>
					<select name="filtergenre" id="filtergenre" onchange="submitFilterForm()">
					<option value="0">Choose..</option>
                        <?php
                            $allBooks = fetchCategories($conn);
					        foreach($allBooks as $row){
						    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
					}
                    ?>
				</select> <br>


</select>
	</form>
</div>

</div>

<?php include 'footer.php';?>