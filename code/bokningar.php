<head>
<title> Massage Side </title>
<!-- Set charset to allow ÅÄÖ -->
<meta charset="UTF-8">
<link rel="stylesheet" href="css/Bokning.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<div class="k">
<?php include 'header.php';
include 'includes/config.php';
?>

<div class="container">

<?php
$todaysdate = date("Y-m-d");


$queryResult = $conn->query("SELECT * FROM bokningar WHERE Datum = curdate() ORDER BY Starttid;");


echo "<div class='row'><div class='col ok m-2'><h2 class='textcenter'>Today</h2>";
    foreach ($queryResult as $row)
{
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<h2 id='sizechange'>" . $row['Datum'] . "</h2>";
    echo "<p class='col ok1'><strong>Namn: </strong>" . $row['Fornamn'] ." ". $row['Efternamn'] .'<br>'."<strong> Telefonnummer: </strong>". $row['Telefonnummer'] . "</p>";
    echo "<p class='col ok1'><strong>Typ av massage: </strong>" . $row['TypAvMassage'] . '<br>'."<strong> Starttid </strong>". $row['Starttid'] . '<br>' ."<strong> Sluttid </strong>". $row['Sluttid'] . "</p>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";


$queryResult2 = $conn->query("SELECT * FROM bokningar WHERE Datum = curdate() +1 ORDER BY Starttid");


echo "<div class='col ok m-2'><h2 class='textcenter'>Tomorrow</h2>";
    foreach ($queryResult2 as $row)
{
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<h2 id='sizechange'>" . $row['Datum'] . "</h2>";
    echo "<p class='col ok1'><strong>Namn: </strong>" . $row['Fornamn'] ." ". $row['Efternamn'] .'<br>'."<strong> Telefonnummer: </strong>". $row['Telefonnummer'] . "</p>";
    echo "<p class='col ok1'><strong>Typ av massage: </strong>" . $row['TypAvMassage'] . '<br>'."<strong> Starttid </strong>". $row['Starttid'] . '<br>' ."<strong> Sluttid </strong>". $row['Sluttid'] . "</p>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";

$queryResult2 = $conn->query("SELECT * FROM bokningar ORDER BY Datum");


echo "<div class='col ok m-2'><h2 class='textcenter'>All</h2>";
    foreach ($queryResult2 as $row)
{
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<h2 id='sizechange'>" . $row['Datum'] . "</h2>";
    echo "<p class='col ok1'><strong>Namn: </strong>" . $row['Fornamn'] ." ". $row['Efternamn'] .'<br>'."<strong> Telefonnummer: </strong>". $row['Telefonnummer'] . "</p>";
    echo "<p class='col ok1'><strong>Typ av massage: </strong>" . $row['TypAvMassage'] . '<br>'."<strong> Starttid </strong>". $row['Starttid'] . '<br>' ."<strong> Sluttid </strong>". $row['Sluttid'] . "</p>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";

echo "</div>";
?>

</div>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>
