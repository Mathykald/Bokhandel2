<?php
include 'includes/config.php';
include 'header.php';
?>
<?php

include_once 'includes/functions.php';

if(isset($_POST['create-author'])){
	  
      $insertedAuthorId = createAuthor($conn, $_POST['author_firstname'], $_POST['author_lastname']);
      
       
      // echo $_post['firstname'];
      // echo $files['bimage'] ['name'];      
   }
?>
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Author info</h3>

  <label id="mt" for="author_firstname">First name:</label><br>
  <input class="colorstuff" type="text" id="author_firstname" name="author_firstname" value=""><br><br>
  

  <label for="author_lastname">Last name:</label><br>
  <input class="colorstuff" type="text" id="author_lastname" name="author_lastname" value=""><br><br>

  <input id="submit" type="submit" name="create-author" value="Send">
</form>

