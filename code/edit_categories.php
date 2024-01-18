<?php
	include 'header.php';



$allCategory = fetchCategories($conn);
foreach($allCategory as $row){
    echo "<h5 value='{$row['category_id']}'>{$row['category_name']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_category_here.php?categoryID={$row['category_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_category.php?categoryID={$row['category_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>