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
        <h3>Soort lid toevoegen</h3>
        <br>
        <div>
            <form action="../controller.php" method="post">
                <p>
                    <label for="soort_lid_beschrijving">Beschrijving:&nbsp;</label>
                    <input type="text" id="soort_lid_beschrijving" name="soort_lid_beschrijving" value=""><br><br>
                </p>
                <p>
                    <label for="soort_lid_staffel">Staffel:</label>
                    <input type="number" id="soort_lid_staffel" name="soort_lid_staffel" min="0" value="1" step="0.01" onkeydown="return false"><br><br>
                </p>
                <input type='submit' value="Toevoegen" name='soort_lid_toevoegen' class="input-submit">
                <br><br>
            </form>
            <?php

                    if(isset($_GET['soortlidtoevoegen'])){
                            $soortlidtoevoegencheck = $_GET['soortlidtoevoegen'];

                            if ($soortlidtoevoegencheck == "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($soortlidtoevoegencheck == "charnaam") {
                                echo "<p class='error'>Kan alleen letters en nummers gebruiken voor het soort lidmaatschap!</p>";
                            }
                            if ($soortlidtoevoegencheck == "succes") {
                                echo "<p class='succes'>Soort lid toegevoegd!</p>";
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