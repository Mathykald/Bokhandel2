<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['publishID'])) {
		$currentpublish = $_GET['publishID'];
		$publishData = selectSinglepublish($conn, $currentpublish);
	} else {
		$errorMessage = "No publish selected";
	}

	if (isset($_POST['deletepublish'])) {
		if (deletepublish($conn, $currentpublish)) {
			header('Location: index.php?publishDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($publishData['publish_name'])) {
        echo "Vill du ta bort " . $publishData['publish_name'] . "?";
    } else {
        echo "publish not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deletepublish" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
