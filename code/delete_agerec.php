<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['agerecID'])) {
		$currentagerec = $_GET['agerecID'];
		$agerecData = selectSingleagerec($conn, $currentagerec);
	} else {
		$errorMessage = "No agerec selected";
	}

	if (isset($_POST['deleteagerec'])) {
		if (deleteagerec($conn, $currentagerec)) {
			header('Location: index.php?agerecDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($agerecData['agerec_name'])) {
        echo "Vill du ta bort " . $agerecData['agerec_name'] . "?";
    } else {
        echo "agerec not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deleteagerec" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
