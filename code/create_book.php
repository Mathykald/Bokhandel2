<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
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

  <?php
  include_once 'includes/functions.php';

  if(isset($_GET['bookID'])){

    $currentBook = $_GET['bookID'];
  
    $bookData = selectSingleBook($conn,$currentBook);
  
  }
  
  
  if(isset($_POST['article-submit'])){
	  
    //$lastInsertedCustomerId = fetchCreator($conn, $_POST['firstname'], $_POST['lastname']);
   
      createBook($conn, $_POST['book_title'], $_POST['book_price'], $_POST['book_rating'], $_POST['book_author'], 
      $_POST['book_illustrator'], $_POST['book_description'], $_POST['book_genre'], $_POST['book_pages'], 
      $_FILES['bimage']['name'], $_POST['book_language'], $_POST['book_agerec'], $_POST['book_publish'], 
      $_POST['book_category'], $_POST['release_date'], $_POST['status_name'], $_POST['uid']);	
  }

  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="create_book.php" enctype="multipart/form-data">

	<h3 id="center">Skapa bok</h3>

  <label id="mt" for="book_title">Title:</label><br>
  <input class="colorstuff" type="text" id="book_title" name="book_title" value=""><br><br>

  <label for="book_price">Pris:</label><br>
  <input class="colorstuff" type="text" id="book_price" name="book_price" value=""><br><br>

  <select name="book_rating" class="book_rating">
  <option value="">Välj rating</option>
  <option value="0,5">0,5</option>
  <option value="1">1</option>
  <option value="1,5">1,5</option>
  <option value="2">2</option>
  <option value="2,5">2,5</option>
  <option value="3">3</option>
  <option value="3,5">3,5</option>
  <option value="4">4</option>
  <option value="4,5">4,5</option>
  <option value="5">5</option>
</select>

<?php
        //  echo "<p>{$row['author_id']}</p>";
      // echo "<p>{$row['author_firstname']} {$row['author_lastname']}</p>";
?>

  <label for="book_author">Författare</label><br>
  <select name="book_author" id="book_author" class="book_author">
  <option>Författare</option>
  <?php
		$allAuthors = fetchAuthors($conn);
		foreach ($allAuthors as $row){
			echo "<option value='{$row['author_id']}'>{$row['author_firstname']} {$row['author_lastname']}</option>";
    }
?>
</select>
<label for="book_illustrator">Illustratörer</label><br>
  <select name="book_illustrator" id="book_illustrator" class="book_illustrator">
  <option>Illustratörer</option>
  <?php
		$allIllustrators = fetchillustrators($conn);
		foreach ($allIllustrators as $row){
			echo "<option value='{$row['illustrator_id']}'>{$row['illustrator_firstname']} {$row['illustrator_lastname']}</option>";
    }
	?>
</select>

<label for="book_description">Beskrivning:</label><br>
  <input class="colorstuff" type="text" id="book_description" name="book_description" value=""><br><br>

  


<label for="book_genre">Välj genre</label><br>
<select name="book_genre" id="book_genre" class="book_genre">
  <option value="">Välj genre</option>
  <?php
		$allgenre = fetchgenre($conn);
		foreach ($allgenre as $row){
			echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
		}
	?>

</select>

<label for="book_pages">Sidor:</label><br>
  <input class="colorstuff" type="text" id="book_pages" name="book_pages" value=""><br><br>

  <label for="bimage">Pärmbild:</label><br>
	<input type="file" name="bimage" id="bimage">

  </select>

<label for="book_language">Välj språk</label><br>
<select name="book_language" id="book_language" class="book_language">
  <option value="">Välj Språk</option>
  <?php
		$alllanguage = fetchlanguages($conn);
		foreach ($alllanguage as $row){
			echo "<option value='{$row['lang_id']}'>{$row['lang_language']}</option>";
		}
	?>

</select>

<label for="book_agerec">Åldersrekommendation</label><br>
<select name="book_agerec" id="book_agerec" class="book_agerec">
  <option value="">Åldersrekommendation</option>
  <?php
		$allagerec = fetchagerec($conn);
		foreach ($allagerec as $row){
			echo "<option value='{$row['agerec_id']}'>{$row['agerec_age']}</option>";
		}
	?>

</select>

<label for="book_publish">Välj förlag</label><br>
<select name="book_publish" id="book_publish" class="pubbook_publishlish">
  <option value="">Välj förlag</option>
  <?php
		$allpublish = fetchpublishes($conn);
		foreach ($allpublish as $row){
			echo "<option value='{$row['publish_id']}'>{$row['publish_name']}</option>";
		}
	?>
</select>
  
<label for="book_category">Välj kategori</label><br>
<select name="book_category" id="book_category" class="book_category">
  <option value="">Välj kategori</option>
  <?php
		$allCategories = fetchCategories($conn);
		foreach ($allCategories as $row){
			echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
		}
	?>
</select>

  
<label for="release_date">Utgivningsdatum:</label><br>
  <input class="colorstuff" type="date" id="release_date" name="release_date" value=""><br><br>


  <!-- <select name="featured_book" id="featured_book" class="featured_book required" >
    <option value="">Välj om utvald</option>
      // <?php
		    // $allFeatured = fetchFeatured($conn);
		    // foreach ($allFeatured as $row){
			  // echo "<option value='{$row['featured_id']}'>{$row['featured_book']}</option>";
		    // }
	    // ?>
  </select> -->


<select name="status_name" class="status_name">
  <option value="1">Finns i lager</option>
  <option value="2">Finns inte i lager</option>

</select>

<input type="hidden" name="uid" value="<?php	echo  $_SESSION['uid'] ?>"> 

  <input id="submit" type="submit" name="article-submit" value="Skapa"><br>

  <a href='create_author.php'>Skapa författare</a><br>
  <a href='create_illustrator.php'>Skapa illustratör</a><br>
  <a href='create_category.php'>Skapa kategori</a><br>
  <a href='create_genre.php'>Skapa genre</a><br>
  <a href='create_agerec.php'>Skapa åldersrekommendation</a><br>
  <a href='create_publish.php'>Skapa förlag</a><br>



</form>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>