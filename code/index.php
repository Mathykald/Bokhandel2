
<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';
?>

<div class="bc">
<?php
$allBooks = selectAllBooks($conn);

if(isset($_GET['sortprice']) && $_GET['sortprice'] != 0){
	$sortCriteria = 'book_price';
	$sortDirection = cleanInput($_GET['sortprice']);
	$selectedBooks = selectSortedBooks($conn, 20, $sortCriteria, $sortDirection);
}

else if(isset($_GET['sortpages']) && $_GET['sortpages'] != 0){
	$sortCriteria = 'car_pages';
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
		<img src='uploads/{$row['book_Img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
			<h5 class'card-title'>{$row['book_Genre']} {$row['Book_Title']}</h5>
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
				<option value="1">Svenska</option>
				<option value="2">Finska</option>
				<?php
					foreach($allBooks as $row){
						echo "<option value='{$row['book_genre']}'>{$row['book_genre']}</option>";
					}?>
			</select> <br>
				<label for="filtergenre">Filter by genre</label>
					<select name="filtergenre" id="filtergenre" onchange="submitFilterForm()">

				</select> <br>
	</form>
</div>


</div>

<?php include 'footer.php';?>