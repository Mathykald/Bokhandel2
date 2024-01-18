<?php
	include 'header.php';
	include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';

	$errorMessage = "";
	if (isset($_GET['categoryID'])) {
		$currentCategory = $_GET['categoryID'];
		$categoryData = selectSingleCategory($conn, $currentCategory);
	} else {
		$errorMessage = "No category selected";
	}

	if (isset($_POST['deletecategory'])) {
		if (deletecategory($conn, $currentCategory)) {
			header('Location: index.php?categoryDeleted=1');
		}
	}
?>

<div class="bc">
    <?php
    if (isset($categoryData['category_name'])) {
        echo "Vill du ta bort " . $categoryData['category_name'] . "?";
    } else {
        echo "Category not found.";
    }
    ?>

    <form method="POST" action="">
        <input type="submit" name="deletecategory" value="Ta bort">
        <button type="button" onclick="goBack()">Tillbaka</button>
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include 'footer.php';?>
