<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['illustratorID'])) {
		$currentillustrator = $_GET['illustratorID'];
		$illustratorData = selectSingleillustrator($conn, $currentillustrator);
	} else {
		$errorMessage = "No illustrator selected";
	}

	if (isset($_POST['deleteillustrator'])) {
		if (deleteillustrator($conn, $currentillustrator)) {
			header('Location: index.php?illustratorDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($illustratorData['illustrator_name'])) {
        echo "Vill du ta bort " . $illustratorData['illustrator_name'] . "?";
    } else {
        echo "illustrator not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deleteillustrator" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
