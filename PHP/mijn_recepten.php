<!DOCTYPE html>
<?php

require 'config.php';

session_start();
if (!isset($_SESSION['Gebruikersnaam'])) {
  $switch = "inlog";
} else {
  $switch = "uitlog";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Style.css"/>
    <link rel="stylesheet" href="../CSS/recepten.css">
    <script src="../JS/JS.js"></script>
</head>
<body>
<div class="Menu">
    <!-- Menu Button -->
    <span onclick="openNav()" class="spanButton">&#9776;</span>

    <!-- Menu -->
    <ul id="mySidenav" class="sidenav">
        <li>
            <a
                    class="test"
                    href="javascript:void(0)"
                    class="closebtn"
                    onclick="closeNav()"
            >&times;</a
            >
        </li>
        <li>
            <a
                    class="test"
                    href="index.php"
                    onclick="setTimeout(closeNav, 800)"
            >home</a
            >
        </li>
        <li>
            <a class="test" href="mijn_recepten.php" onclick="setTimeout(closeNav, 800)"
            >Mijn recepten</a
            >
        </li>
        <li>
            <a class="test" href="recepte_maken.php" onclick="setTimeout(closeNav, 800)"
            >Recepten maken</a
            >
        </li>
    </ul>
</div>
<header>
    <div class="Search">
        <form action="search.php" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <h1>Japan</h1>
    <button><a href="<?php echo $switch; ?>.php"><?php echo $switch; ?></a></button>

</header>
<div class="user">
    <?php
    $opdracht = "SELECT * FROM Beroeps_User WHERE User_ID =" . $_SESSION['User_ID'];
    $resultaat = mysqli_query($mysqli, $opdracht);
    while ($profielfoto = mysqli_fetch_array($resultaat)){
        echo "<tr><td> <img class='imgprofile' src='..//Resorce/ProfielFoto/" . $profielfoto['UserProfile'] . "'/></td></tr>";
    }
    ?>
    <p>Welkom <?php echo $_SESSION['Gebruikersnaam']?></p>
</div>
<?php
$query = "SELECT * FROM Beroeps_Recept WHERE Recept_ID IN (SELECT Recept_ID FROM Beroeps_Kopeling WHERE User_ID =" . $_SESSION['User_ID'] . ")";

// als de opdracht goed word uitgevoerd:
if ($Resultaat = mysqli_query($mysqli, $query)) {
  while ($Recept = mysqli_fetch_array($Resultaat)) {
    echo "<div class='recept'>";
    echo "<img class='imgrecept' src='..//Resorce/ReceptFoto/" . $Recept['Image'] . "' width='200px'  height='200px'/>";
    echo "<div class='info'>";
    echo "<div class='top'>";
    echo "<div><h2 class='title'>" . $Recept['Title'] . "</h2></div>";
    echo "<div class='category'><p>" . $Recept['Category'] . "</p></div>";
    echo "</div>";
    echo "<div class='text'>" . $Recept['Text'] . "</div>";
    echo " </div>";
    echo " </div>";
  }
} // anders:
else {
  echo "<p>FOUT bij opzoeken.</p>";
  echo mysqli_error($mysqli); //LET OP: tijdelijk toegevoegen
}

?>

</body>
</html>
