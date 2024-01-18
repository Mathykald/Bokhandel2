<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['genreID'])){

	$currentgenre = $_GET['genreID'];

	$genreData = selectSinglegenre($conn,$currentgenre);



}

else{

    $errorMessage = "No book has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	 
	 //laga dom i rätt ordning som formen klart.
	 $a = updategenre($conn, $_GET['genreID'], $_FILES['bimage']['name'], $_POST['cname']);	
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
  <input class="colorstuff" type="" id="cname" name="cname" value="<?php if(isset($genreData['genre_name'])){echo $genreData['genre_name'];} ?>" required="required"><br><br>

  <label for="cimage">Bild:</label><br>
  <input class="colorstuff" type="file" id="cimage" value="<?php if(isset($genreData['genre_img'])){echo $genreData['genre_img'];} ?>" name="cimage"><br><br>
 
  <label for="author">Kategori</label><br>
	<?php
		$allgenre = fetchgenre($conn);
		foreach ($allgenre as $row){
			echo "<input type='text' value='{$row['genre_id']}'>{$row['genre_name']}";
		}
	?>
  
  <br><br>




<input id="submit" type="submit" name="article-updated" value="Uppdate"><br>





</form>
</div>
</div>
</div>
</div>
