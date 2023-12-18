
<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	
	$errorMessage = "";
	if(isset($_GET['bookID'])){
		$currentBook = $_GET['bookID'];
		$bookData = selectSingleBook($conn,$currentBook);
		}
		
		else {
			$errorMessage = "No book selected";
		}
		

		
		if(isset($_POST['deletebook'])){ 
		if(deleteBook($conn, $currentBook)){
		header('Location: index.php?bookDeleted=1'); 
		}}
		
		
		
		
?>
<div class="bc">
<?php
echo "Vill du ta bort " . $bookData['book_title'] . " av " . $bookData['author_firstname'] . "?";
?>

<form method="POST" action="">    <input type="submit" name="deletebook" value="Ta bort">    <input type="submit" name="goback" value="Tillbaka"></form>


</div>
<?php include 'footer.php';?>