<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
include 'header.php';
?>

  <?php
  include_once 'includes/functions.php';
  
  
  if(isset($_POST['article-submit'])){
	  
	 $lastInsertedAuthorId = createAuthor($conn, $_POST['author_firstname'], $_POST['author_lastname']);
	  
	  
	 // echo $_post['firstname'];
	 // echo $files['cimage'] ['name'];
	 
  }
  ?>
<div id="wholeting">
<div id="formcss">
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Create book</h3>

  <label id="mt" for="firstname">First name:</label><br>
  <input class="colorstuff" type="text" id="firstname" name="firstname" value=""><br><br>
  

  <label for="lastname">Last name:</label><br>
  <input class="colorstuff" type="text" id="lastname" name="lastname" value=""><br><br>

  <select name="author">
  <option value="">Välj författare</option>
  <?php
		$allAuthors = fetchAuthors($conn);
		foreach ($allAuthors as $row){
			echo "<option value='{$row['author_id']}'>{$row['author_firstname']} {$row['author_lastname']}</option>";
		}
	?>

</select>

<select name="category">
  <option value="">Välj kategori</option>
  <?php
		$allCategories = fetchCategories($conn);
		foreach ($allCategories as $row){
			echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
		}
	?>

</select>

<select name="illustrator">
  <option value="">Välj illustratör</option>
  <?php
		$allIllustrators = fetchillustrators($conn);
		foreach ($allIllustrators as $row){
			echo "<option value='{$row['illustrator_id']}'>{$row['illustrator_firstname']} {$row['illustrator_lastname']}</option>";
		}
	?>

</select>
</p>
  <input id="submit" type="submit" name="article-submit" value="Send"><br>

  <a href='create_author.php'>Create Author</a> <br>
  <a href='create_illustrator.php'>Create Illustrator</a> <br>
  <a href='create_category.php'>Create Category</a>

</form>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>