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
        <h3>Familielid toevoegen</h3>
        
        <br>
        <a href="OverzichtFamilie.php" class="btn-toevoegen">Terug naar familie</a></button>
        <div>
            <form action="../controller.php" method="post">
                <p>
                    <label for="familielid_naam">Voornaam:</label>
                    <input type="text" id="familielid_naam" name="familielid_naam" value=""><br><br>
                </p>
                <p>
                    <label for="geboortedatum">Geboortedatum:&nbsp;</label>
                    <input type="date" id="geboortedatum" name="geboortedatum" value=""><br><br>
                </p>
                <p>
                    <label for="soort_lid">Soort lid:</label>
                    <select type="text" id="soort_lid" name="soort_lid" value="">
                    <?php
                    include("../controller.php");
                    $soorten_leden = get_soorten_leden();
                    while ($row = $soorten_leden->fetch()){
                        $td1 = htmlspecialchars($row['id']);
                        $td2 = htmlspecialchars($row['omschrijving']);
                    ?>
                    <option value="<?= $td2?>"><?= $td2?></option>
                    <?php }?>
                    </select><br><br>
                </p>
                <p>
                    <label for="leeftijdscategorie">Leeftijdscategorie:&nbsp;</label>
                    <select type="text" id="leeftijdscategorie" name="leeftijdscategorie" value="">
                    <?php
                    $leeftijdscategotieën = get_leeftijdscategorieën();
                    while ($row = $leeftijdscategotieën->fetch()){
                        $td1 = htmlspecialchars($row['id']);
                        $td2 = htmlspecialchars($row['omschrijving']);
                    ?>
                    <option value="<?= $td1?>"><?= $td2?></option>
                    <?php }?>
                    </select><br><br>
                </p>
                <input type='submit' name='familielid_toevoegen' value='Toevoegen'>
            </form>
            <br>
            <?php

            if(isset($_GET['familielidtoevoegen'])){

                    $familielidtoevoegencheck = $_GET['familielidtoevoegen'];

                    if ($familielidtoevoegencheck == "empty") {
                        echo "<p class='error'>Vul alle velden in!</p>";
                    }
                    if ($familielidtoevoegencheck == "charnaam") {
                        echo "<p class='error'>Kan alleen letters en nummers gebruiken voor de voornaam!</p>";
                    }
                    if ($familielidtoevoegencheck == "succes") {
                        echo "<p class='succes'>Familielid toegevoegd!</p>";
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