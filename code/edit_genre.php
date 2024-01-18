<?php
	include 'header.php';



$allgenre = fetchgenre($conn);
foreach($allgenre as $row){
    echo "<h5 value='{$row['genre_id']}'>{$row['genre_name']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_genre_here.php?genreID={$row['genre_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_genre.php?genreID={$row['genre_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>