<?php
	include 'header.php';



$allauthor = fetchauthors($conn);
foreach($allauthor as $row){
    echo "<h5 value='{$row['author_id']}'>{$row['author_firstname']} {$row['author_lastname']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_author_here.php?authorID={$row['author_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_author.php?authorID={$row['author_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>