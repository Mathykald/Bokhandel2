
<?php 
include 'header.php';
include 'includes/functions.php';
include 'includes/config.php';

?>
<div class="bc">
<?php
$errorMessage = "";




if(isset($_GET['bookID'])){

$currentBook = $_GET['bookID'];

$bookData = selectSingleBook($conn,$currentBook);
}

else{
    $errorMessage = "No book has been chosen.";
}

?>
<p class="error-message m-0">
<?php
if ($errorMessage != "") {
    echo $errorMessage;
}

echo "</p>";

echo "<div id='yes'>";
echo "</div>";

echo "<div class='pb-5 marginsinglecar'>";


echo "</div>";

echo "<div class='container'>
			<div class='col-md-12'>
				<div class='card mb-3'>
					<div class='row no-gutters align-items-center'>
						<div class='col-md-4'>
             <img src='uploads/{$bookData['book_img']}' id='maregin' class='' alt='...'>. '<br>';
						</div>
						<div class='col-md-8'>
							<div class='card-body'>
                                <h5 class='card-title'>{$bookData['book_title']}</h5>
                                <p class='card-text'>{$bookData['book_description']}.</p>
                                <p class='card-text'>Åldersrekommendation: {$bookData['agerec_age']}</small></p>
                                <p class='card-text'>Författare: {$bookData['author_firstname']}</small></p>
                                <p class='card-text'>illustratör: {$bookData['illustrator_firstname']}</small></p>
                                <p class='card-text'>Språk: {$bookData['lang_language']}</small></p>
                                <p class='card-text'>Genre: {$bookData['genre_name']}</small></p>
                                <p class='card-text'>Kategori: {$bookData['category_name']}</small></p>
                                <p class='card-text'>Förlag: {$bookData['publish_name']}</small></p>
                                <p class='card-text'>Sidor: {$bookData['book_pages']}</small></p>
                                <p class='card-text'>Rating: {$bookData['book_rating']}/5</small></p>
                                <p class='card-text'>pris: {$bookData['book_price']}€</small></p>
								<p class='card-text'>Utgivningdatum: {$bookData['release_date']}</small></p>
                                <p class='card-text'>Status: {$bookData['status_name']}</small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- row -->
	</div>";
?>

<?php include 'footer.php' ?>