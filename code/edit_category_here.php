<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['categoryID'])){

	$currentCategory = $_GET['categoryID'];

	$categoryData = selectSingleCategory($conn,$currentCategory);



}

else{

    $errorMessage = "No book has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	 
	 //laga dom i rätt ordning som formen klart.
	 $a = updateCategory($conn, $_GET['categoryID'], $_FILES['bimage']['name'], $_POST['cname']);	
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
  
  <label for="cname">Kategori</label><br>
  <input class="colorstuff" type="" id="cname" name="cname" value="<?php if(isset($categoryData['category_name'])){echo $categoryData['category_name'];} ?>" required="required"><br><br>

  <label for="cimage">Bild:</label><br>
  <input class="colorstuff" type="file" id="cimage" value="<?php if(isset($categoryData['category_img'])){echo $categoryData['category_img'];} ?>" name="cimage"><br><br>
 
  <label for="author">Kategori</label><br>
	<?php
		$allCategory = fetchCategories($conn);
		foreach ($allCategory as $row){
			echo "<input type='text' value='{$row['category_id']}'>{$row['category_name']}";
		}
	?>
  
  <br><br>




<input id="submit" type="submit" name="article-updated" value="Uppdate"><br>





</form>
</div>
</div>
</div>
</div>
