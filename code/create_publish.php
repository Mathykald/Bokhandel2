<?php
include 'includes/config.php';
include 'header.php';
?>
<?php

include_once 'includes/functions.php';

if(isset($_POST['create-publish'])){
	  
      $insertedFörlagId = createPublish($conn, $_POST['publish_name']);
      
       
      // echo $_post['firstname'];
      // echo $files['bimage'] ['name'];      
   }
?>
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Skapa Förlag</h3>

  <label id="mt" for="publish_name">Namn:</label><br>
  <input class="colorstuff" type="text" id="publish_name" name="publish_name" value=""><br><br>

  <input id="submit" type="submit" name="create-publish" value="Skapa">
</form>

