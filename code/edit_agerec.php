<?php
	include 'header.php';



$allagerec = fetchagerec($conn);
foreach($allagerec as $row){
    echo "<h5 value='{$row['agerec_id']}'>{$row['agerec_age']}</h5>";
    if($user->checkLoginStatus()){
    if($user->checkUserRole(50)){
    echo "<a class='tingeling' href='edit_agerec_here.php?agerecID={$row['agerec_id']}'>Edit kategori</a><br>";
    echo "<a class='tingeling' href='delete_agerec.php?agerecID={$row['agerec_id']}'>Radera kategori</a>";
}
}
}


?>
<?php
	include 'footer.php';
?>