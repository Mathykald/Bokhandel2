<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['genreID'])) {
		$currentgenre = $_GET['genreID'];
		$genreData = selectSinglegenre($conn, $currentgenre);
	} else {
		$errorMessage = "No genre selected";
	}

	if (isset($_POST['deletegenre'])) {
		if (deletegenre($conn, $currentgenre)) {
			header('Location: index.php?genreDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($genreData['genre_name'])) {
        echo "Vill du ta bort " . $genreData['genre_name'] . "?";
    } else {
        echo "genre not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deletegenre" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
