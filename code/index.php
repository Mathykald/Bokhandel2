
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
	$selectedBooks = selectSortedBooks($conn, 20, $sortCriteria, $sortDirection);
}

else if(isset($_GET['sortpages']) && $_GET['sortpages'] != 0){
	$sortCriteria = 'book_pages';
	$sortDirection = cleanInput($_GET['sortpages']);
	$selectedBooks = selectSortedBooks($conn, 20, $sortCriteria, $sortDirection);
}

else {
	$selectedBooks = selectBooks($conn, 20);
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
			<p>Beskrivning</p>
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
			<option value="1">Yes</option>
			<option value="2">No</option>
		</select> <br>
		<label for="sortpages">Sort by pages:</label>
		<select name="sortpages" id="sortpages" onchange="submitSortForm()">
			<option value="0">Choose..</option>
			<option value="1">Yes</option>
			<option value="2">No</option>
		</select> <br>
	</form>
	<form action="" method="GET" id="filterform">
		

		<label for="filterlanguage">Filter by language:</label>
			<select name="filterlanguage" id="filterlanguage" onchange="submitFilterForm()">
			<option value="0">Choose..</option>
			<?php
					foreach($allBooks as $row){
						echo "<option value='{$row['book_lang_fk']}'>{$row['book_lang_fk']}</option>";
					}?>
			</select> <br>
				<label for="filtergenre">Filter by genre</label>
					<select name="filtergenre" id="filtergenre" onchange="submitFilterForm()">
					<option value="0">Choose..</option>
			<?php
					foreach($allBooks as $row){
						echo "<option value='{$row['book_genre_fk']}'>{$row['book_genre_fk']}</option>";
					}?>
				</select> <br>
	</form>
</div>

</div>

<?php include 'footer.php';?>