<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['bookID'])){

	$currentBook = $_GET['bookID'];

	$bookData = selectSingleBook($conn,$currentBook);



}

else{

    $errorMessage = "No book has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	 
	 //laga dom i rätt ordning som formen klart.
	 $a = updateBook($conn, $_POST['title'], $_POST['price'], $_POST['rating'], $_POST['author'], $_POST['illustrator'], $_POST['description'], $_FILES['bimage'], $_POST['pages'], $_POST['release_date'], $_POST['agerec'], $_POST['category'], $_POST['language'], $_POST['publish']);	
	 var_dump($a);
	header("Refresh:1");
	  
	  
	  
	  
	 // echo $_post['firstname'];
	 // echo $files['bimage'] ['name'];
	 
	 
  }
  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="" enctype="multipart/form-data">
  
  <div id="cars">

  <h3>Book info</h3>
  
  <label for="title">Titel</label><br>
  <input class="colorstuff" type="" id="title" name="title" value="<?php if(isset($bookData['book_title'])){echo $bookData['book_title'];} ?>" required="required"><br><br>
  
  <label for="price">Pris</label><br>
  <input class="colorstuff" type="" id="price" value="<?php if(isset($bookData['book_price'])){echo $bookData['book_price'];} ?>€" name="price"><br><br>
  
   <label for="rating">Rating</label><br>
  <input class="colorstuff" type="" id="rating" value="<?php if(isset($bookData['book_rating'])){echo $bookData['book_rating'];} ?>/5" name="rating"><br><br>
  
    <label for="author">Författare</label><br>
    <select name="author" id="author" class="author"><br><br> 
  
	<?php
		$allAuthors = fetchAuthors($conn);
		foreach ($allAuthors as $row){
			echo "<option value='{$row['author_id']}'>{$row['author_firstname']}</option>";
		}
	?>
  
  </select> <br><br>
  
  
    <label for="illustrator">Illustratör</label><br>
    <select name="illustrator" id="illustrator" class="illustrator"><br><br> 
    
  
	<?php
		$allillustrator = fetchillustrators($conn);
		foreach ($allillustrator as $row){
			echo "<option value='{$row['illustrator_id']}'>{$row['illustrator_firstname']}</option>";
		}
	?>
  
    <label for="description">Beskrivning</label><br>
  <input class="colorstuff" type="" id="description" value="<?php if(isset($bookData['book_description'])){echo $bookData['book_description'];} ?>" name="description"><br><br>
  
    <label for="genre">Genre</label><br>
    <select name="genre" id="genre" class="genre"><br><br> 
  <?php
		$allgenre = fetchgenre($conn);
		foreach ($allgenre as $row){
			echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
		}
	?>
  
  </select> <br><br>
  
  <label for="pages">Sidor: </label><br>
  <input class="colorstuff" type="" id="pages" value="<?php if(isset($bookData['book_pages'])){echo $bookData['book_pages'];} ?>" name="pages"><br><br>
  
  <label for="book_language">Välj språk</label><br>
<select name="book_language" class="book_language">
  <?php
		$alllanguage = fetchlanguages($conn);
		foreach ($alllanguage as $row){
			echo "<option value='{$row['lang_id']}'>{$row['lang_language']}</option>";
		}
	?>
  
  </select> <br><br>
  
  <label for="book_agerec">Åldersrekommendation</label><br>
<select name="book_agerec" class="book_agerec">
  <?php
		$allagerec = fetchagerec($conn);
		foreach ($allagerec as $row){
			echo "<option value='{$row['agerec_id']}'>{$row['agerec_age']}</option>";
		}
	?>
</select>

<label for="book_publish">Välj förlag</label><br>
<select name="book_publish" class="book_publish">
  <?php
		$allpublish = fetchpublishes($conn);
		foreach ($allpublish as $row){
			echo "<option value='{$row['publish_id']}'>{$row['publish_name']}</option>";
		}
	?>
</select>

<label for="book_category">Välj kategori</label><br>
<select name="book_category" class="book_category">
  <?php
		$allCategories = fetchCategories($conn);
		foreach ($allCategories as $row){
			echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
		}
	?>
</select>

<label for="release_date">Utgivningsdatum</label><br>
  <input class="colorstuff" type="date" id="release_date" value="<?php if(isset($bookData['release_date'])){echo $bookData['release_date'];} ?>" name="release_date"><br><br>


  
  
  <select name="status_name" class="status_name">
  <option value="1">Finns i lager</option>
  <option value="2">Finns inte i lager</option>

</select> 
	
  <input id="submit" type="submit" name="article-updated" value="Uppdate"><br>



</form>
</div>
</div>
</div>
</div>

