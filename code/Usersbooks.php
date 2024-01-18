
<?php
	include 'header.php';

    if($user->checkLoginStatus()){
        if(!$user->checkLoginStatus(true)){
            $user->redirect("create_book.php");
        }
    }   
    else{
        $user->redirect("index.php");
    }
?>


	
	
<div class="bc">
	
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
	echo "<div class='container'>";
	echo "<div class='row'>";


    foreach ($selectedBooks as $row){
        
    echo "
	<div id='bksomelese'class='card m-2 col-sm-2'>
		<img src='uploads/{$row['book_img']}' class='card-img-top' alt'...'>
		<div class='card-body'>
		<h5 class'card-title'>{$row['book_title']}</h5><br>
		<p>Pris: {$row['book_price']}€</p>
		<p class='card-text'>Sidor: {$row['book_pages']}<p>
		<a class='tingeling' href='single_Book.php?bookID={$row['book_id']}'>Se all info</a><br>
				<a class='tingeling' href='edit_book.php?bookID={$row['book_id']}'>Editera bok info</a><br>
				<a class='tingeling' href='deletebook.php?bookID={$row['book_id']}'>Radera bok</a>

				</div> 
		</div>
		";
}
echo "</div>";
echo "</div>";

?>

</div>



<?php include 'footer.php';?>