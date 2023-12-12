<?php
include 'includes/config.php';
include 'header.php';
?>
<?php

include_once 'includes/functions.php';

if(isset($_POST['create-illustrator'])){
	  
      $insertedIllustratorId = createIllustrator($conn, $_POST['illustrator_firstname'], $_POST['illustrator_lastname']);
      
       
      // echo $_post['firstname'];
      // echo $files['cimage'] ['name'];      
   }
?>
<form method="post" action="" enctype="multipart/form-data">

	<h3 id="center">Create illustrator</h3>

  <label id="mt" for="illustrator_firstname">First name:</label><br>
  <input class="colorstuff" type="text" id="illustrator_firstname" name="illustrator_firstname" value=""><br><br>
  

  <label for="illustrator_lastname">Last name:</label><br>
  <input class="colorstuff" type="text" id="illustrator_lastname" name="illustrator_lastname" value=""><br><br>

  <input id="submit" type="submit" name="create-illustrator" value="Send">
</form>

