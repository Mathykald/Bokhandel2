<?php
	include 'header.php';



$allpublish = fetchpublishes($conn);
foreach($allpublish as $row){
    echo "<h5 value='{$row['publish_id']}'>{$row['publish_name']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_publish_here.php?publishID={$row['publish_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_publish.php?publishID={$row['publish_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>