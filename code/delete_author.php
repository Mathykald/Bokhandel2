<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['authorID'])) {
		$currentauthor = $_GET['authorID'];
		$authorData = selectSingleauthor($conn, $currentauthor);
	} else {
		$errorMessage = "No author selected";
	}

	if (isset($_POST['deleteauthor'])) {
		if (deleteauthor($conn, $currentauthor)) {
			header('Location: index.php?authorDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($authorData['author_name'])) {
        echo "Vill du ta bort " . $authorData['author_name'] . "?";
    } else {
        echo "author not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deleteauthor" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
