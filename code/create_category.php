<?php
include 'includes/config.php';
include 'header.php';
?>
<?php

include_once 'includes/functions.php';

if(isset($_POST['create-category'])){
	  
      $insertedCategoryId = createCategory($conn, $_POST['category_name'], $_FILES['category_img']['name']);
      
       
      // echo $_post['firstname'];
      // echo $files['cimage'] ['name'];      
   }
?>
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Create category</h3>

  <label id="mt" for="category_name">Category:</label><br>
  <input class="colorstuff" type="text" id="category_name" name="category_name" value=""><br><br>
  
  <label for="category_img">Bild:</label><br>
	<input type="file" name="category_img" id="category_img">

  <input id="submit" type="submit" name="create-category" value="Send">
</form>

