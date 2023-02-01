<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('HTTP/1.1 403 Forbidden');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="header">
        <h2>Ledenadministratie<h2>
        <form action="../controller.php" method="post" class="btn-toevoegen">
            <button  name="logout">Log out</button>
        </form>
    </header>
    <div class="content">
        <h3>Familie toevoegen</h3>
        <br>
        <div>
            <form action="../controller.php" method="post">
                <p>
                    <label for="familie_naam">Naam:</label>
                    <input type="text" id="familie_naam" name="familie_naam" value=""><br><br>
                </p>
                <p>
                    <label for="adres">Adres:</label>
                    <input type="text" id="adres" name="adres" value=""><br><br>
                </p>
                <button>Toevoegen</button>
            </form>
            <br>
            <?php

            if(isset($_GET['familietoevoegen'])){

                    $familietoevoegencheck = $_GET['familietoevoegen'];

                    if ($familietoevoegencheck == "empty") {
                        echo "<p class='error'>Vul alle velden in!</p>";
                    }
                    if ($familietoevoegencheck == "charnaam") {
                        echo "<p class='error'>Kan alleen letters gebruiken voor de naam!</p>";
                    }
                    if ($familietoevoegencheck == "charadres") {
                        echo "<p class='error'>Kan alleen letters en nummers gebruiken voor het adres!</p>";
                    }
                    if ($familietoevoegencheck == "succes") {
                        echo "<p class='succes'>Familie toegevoegd!</p>";
                    }
            }
            ?>
        </div>
    </div>
        <nav class="nav">
            <a href="OverzichtLedenadministratie.php">Overzicht ledenadministratie</a>
            <a href="Soortenleden.php">Soorten leden</a>
            <a href="Leeftijdscategorie.php">Leeftijdscategorie</a>
            <a href="BasisbedragContributie.php">Basisbedrag contributie</a>
        </nav>
        <footer class="footer"></footer>


</body>

</html>