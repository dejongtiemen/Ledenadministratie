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
        <h3>Leeftijdscategorie toevoegen</h3>
        <br>
        <div>
            <form action="../controller.php" method="post">
                <p>
                    <label for="leeftijdscategorie_beschrijving">Beschrijving:&nbsp;</label>
                    <input type="text" id="leeftijdscategorie_beschrijving" name="leeftijdscategorie_omschrijving" value=""><br><br>
                </p>
                <p>
                    <label for="leeftijdscategorie_staffel">Staffel:</label>
                    <input type="number" id="leeftijdscategorie_staffel" name="leeftijdscategorie_staffel" min="0" value="1" step="0.01" onkeydown="return false"><br><br>
                </p>
                <input type='submit' value="Toevoegen" name='leeftijdscategorie_toevoegen' class="input-submit">
            </form>
            <br>
            <?php

                    if(isset($_GET['leeftijdscategorietoevoegen'])){
                            $leeftijdscategorietoevoegencheck = $_GET['leeftijdscategorietoevoegen'];

                            if ($leeftijdscategorietoevoegencheck == "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($leeftijdscategorietoevoegencheck == "charnaam") {
                                echo "<p class='error'>Kan alleen letters en nummers gebruiken voor het soort lidmaatschap!</p>";
                            }
                            if ($leeftijdscategorietoevoegencheck == "succes") {
                                echo "<p class='succes'>Leeftijdscategorie toegevoegd!</p>";
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