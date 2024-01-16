
<?php
	include 'header.php';

// Check if the form is submitted
if (isset($_GET['sort-submit'])) {
    $sortPrice = $_GET['sortprice'];
    $sortPages = $_GET['sortpages'];

    // Check if $sortPrice or $sortPages has a valid value
    if (($sortPrice == 1 || $sortPrice == 2) && ($sortPages == 1 || $sortPages == 2)) {
        // Call the selectSortedBooks function
        $sortedBooks = selectSortedBooks($conn, $sortPrice, $sortPages);
    } else {
        // Handle invalid values or show an error message
        echo "Invalid sorting criteria or direction.";
    }
}


if (isset($_GET['filter-submit'])) {
    $languageId = $_GET['filterlanguage'];
    $categoryId = $_GET['filtercateogry'];
    $genreId = $_GET['filtergenre'];

    $filteredBooks = selectFilteredBooks($conn, $languageId, $categoryId, $genreId);
}

?>

<div class="bc">

<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>


<?php
if(isset($_POST['searchbook_submit'])){
	$bookList = $user->searchBooks();
}

$displayBooks = !empty($filteredBooks) ? $filteredBooks : everyBook($conn);



/*if(isset($_GET['sortprice']) && $_GET['sortprice'] != 0){
	$sortCriteria = 'book_price';
	$sortDirection = cleanInput($_GET['sortprice']);
	$everyBook = selectSortedBooks($conn, $sortCriteria, $sortDirection);
}

else if(isset($_GET['sortpages']) && $_GET['sortpages'] != 0){
	$sortCriteria = 'book_pages';
	$sortDirection = cleanInput($_GET['sortpages']);
	$everyBook = selectSortedBooks($conn, $sortCriteria, $sortDirection);
}*/

    echo "<form method='POST' action=''>";
    echo "<h4 class='mt-3' for='searchinput'>Sök efter bok</h4>";
    echo "<input class='mb-3' style='width: 250px; height: 32px;' type='text' onkeyup='showResult(this.value)' id='searchinput' name='search_bookname' placeholder='Ange titel, författare osv...'>";
	echo "<div id='livesearch'></div>";
    echo "</form>";
	
    echo "<div class='container'>";
    echo "<h3>Populära kategorier</h3>";
    echo "<h3>Nya böcker</h3>";
    echo "<h3>Featured böcker</h3>";
	echo "<div class='row'>";
    foreach ($displayBooks as $row) {
        echo "<div id='bksomelese' class='card m-3 col-sm-2'>";
        echo "<a class='tingeling' href='single_Book.php?bookID={$row['book_id']}'><img src='uploads/{$row['book_img']}' class='card-img-top' alt='Bok pärmbild'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$row['book_title']}</h5></a>";
        echo "<p class='card-text'></p>";
        echo "</div>";
        echo "<p>{$row['book_description']}</p>";
        echo "<p>{$row['book_price']}€</p>";
        echo "<p>Sidor: {$row['book_pages']}</p>";
        echo "<a class='tingeling' href='single_Book.php?bookID={$row['book_id']}'>View full info</a>";
        echo "</div>";
    }

    if (empty($displayBooks)) {
        echo "<p>No matching books found.</p>";
    }

	echo "</div>";
    echo "</div>";
    echo "<div>";
    echo "<div id='wearebest' class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-6'>";
    echo "<img id='pfppic' src='images/60111.jpg' alt='Bild på företages logo'>";
    echo "</div>";
    echo "<div class='col-6'>";
    echo "<h4>Vi är bäst</h4>";
    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";


    echo "<div id='contactinfo' class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-6'>";
    echo "<h3>Kontaktuppgifter</h3>";
    echo "<p>Telefon: 040 2587932</p>";
    echo "<p>E-post: Bokhandel@gmail.com</p>";
    echo "<p>Adress: Bokhandelvägen 17</p>";
    echo "</div>";
    echo "<div class='col-6'>";
    echo "<img id='pfppic' src='images/221350-P1JPTN-142.jpg' alt='Bild på företages logo'>";
    echo "</div>";
    echo "</div>";
    
    

    /* Filter */?>
    
    <div class="sidebar pt-3 col-sm-4 bg-light">
	<div class="sidebar pt-3 col-sm-4 bg-light">
    <form action="" method="GET" id="filterform">
    
        <label for="filterlanguage">Filtrera med language:</label>
        	<select name="filterlanguage" id="filterlanguage">
    	        <option value="0">Choose..</option>
	                <?php
                        $allBooks = fetchlanguages($conn);
				        foreach($allBooks as $row){
						    echo "<option value='{$row['lang_id']}'>{$row['lang_language']}</option>";
                        }
                    ?>
	        </select><br>
         
        <label for="filtercateogry">Filtrera med Kategori</label>
			<select name="filtercateogry" id="filtercateogry">
				<option value="0">Choose..</option>
                	<?php
            	        $allBooks = fetchCategories($conn);
				        foreach($allBooks as $row){
						    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
						}
                    ?>
			</select><br>

		<label for="filtergenre">Filtrera med genre</label>
			<select name="filtergenre" id="filtergenre">
				<option value="0">Choose..</option>
	                <?php
	                    $allBooks = fetchgenre($conn);
	                    foreach ($allBooks as $row){
			                echo "<option value='{$row['genre_id']}'>{$row['genre_name']}</option>";
	                   }
                    ?>
		    </select> <br>
			<input id="filter" type="submit" name="filter-submit" value="Filter"><br>
	</form><br>

	







	<form action="" method="GET" id="sortform">
		<label for="sortprice">Sortera Pris:</label>
        <select name="sortprice" id="sortprice">
        	<option value="0">Choose..</option>
        	<option value="1">Billigaste-Dyrast</option>
          	<option value="2">Dyraste-Billigast</option>
    	</select> <br>
        <label for="sortpages">Sortera Sidantal:</label>
        <select name="sortpages" id="sortpages">
            <option value="0">Choose..</option>
            <option value="1">Lägsta sidantal</option>
            <option value="2">Högsta sidantal</option>
        </select>
		<input id="Sort" type="submit" name="sort-submit" value="Sort"><br>

	</form>
</div>

</div>
    </div>
</div>

<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>



<?php include 'footer.php';?>