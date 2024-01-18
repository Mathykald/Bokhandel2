<link rel="stylesheet" href="style.css">

<?php
include 'includes/config.php';
?>

  <?php
  include 'header.php';
  include 'includes/fileuppload.php';
  include_once 'includes/functions.php';
  
  if(isset($_GET['agerecID'])){

	$currentagerec = $_GET['agerecID'];

	$agerecData = selectSingleagerec($conn,$currentagerec);



}

else{

    $errorMessage = "No book has been chosen.";

}
  
  if(isset($_POST['article-updated'])){
	 
	 //laga dom i rätt ordning som formen klart.
	 $a = updateagerec($conn, $_GET['agerecID'], $_FILES['bimage']['name'], $_POST['cname']);	
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
  <input class="colorstuff" type="" id="cname" name="cname" value="<?php if(isset($agerecData['agerec_age'])){echo $agerecData['agerec_age'];} ?>" required="required"><br><br>

 
  <label for="author">Kategori</label><br>
	<?php
		$allagerec = fetchagerec($conn);
		foreach ($allagerec as $row){
			echo "<input type='text' value='{$row['agerec_id']}'>{$row['agerec_age']}";
		}
	?>
  
  <br><br>




<input id="submit" type="submit" name="article-updated" value="Uppdate"><br>





</form>
</div>
</div>
</div>
</div>
