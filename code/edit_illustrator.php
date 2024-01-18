<?php
	include 'header.php';



$allillustrator = fetchillustrator($conn);
foreach($allillustrator as $row){
    echo "<h5 value='{$row['illustrator_id']}'>{$row['illustrator_name']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_illustrator_here.php?illustratorID={$row['illustrator_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_illustrator.php?illustratorID={$row['illustrator_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>