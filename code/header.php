<?php
include 'includes/config.php';
	include 'includes/functions.php';
	include 'includes/fileuppload.php';
  ?>
<!DOCTYPE html>  
<html>  
<head>  
<title> Programmering - Bokhandel </title>  
<!-- Set charset to allow ÅÄÖ -->
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script defer src="script.js"></script>
</head>
<body>

<nav id="padmar" class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand color" href="index.php">Bokhandel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active color" aria-current="page" href="create_book.php" >Create Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active color" href="books.php">Books</a>
        </li>
    </ul>
    </div>
  </div>
</nav>

