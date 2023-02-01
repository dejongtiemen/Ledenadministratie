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
        <h3>Overzicht ledenadministratie</h3>
        <a href="FamilieToevoegen.php" class="btn-toevoegen">Familie toevoegen</a></button><br><br>
        <div class="table">
            <div class="table-header">
                <div class="table-header-cell">Familie</div>
                <div class="table-header-cell">Adres</div>
                <div class="table-header-cell">Contributie</div>
            </div>

            <?php
            include("../controller.php");
            $families = get_families();
            while ($row = $families->fetch()) {
                $td1 = htmlspecialchars($row['id']);
                $td2 = htmlspecialchars($row['naam']);
                $td3 = htmlspecialchars($row['adres']);
                $huidige_familie = get_familie($td1);
                $contributie_familie = 0;
                while($row2 = $huidige_familie->fetch()){
                    $soort_lid_id = htmlspecialchars($row2['soort_lid']);
                    $leeftijdscategorie_id = htmlspecialchars($row2['leeftijdscategorie']);
                    $contributie = get_contributie_familielid($soort_lid_id, $leeftijdscategorie_id);
                    $contributie_familie += $contributie;
                }

                ?>
                <form action='../controller.php' method='post' class="table-row">
                    <div class="table-cell"><input  type='input' name='familie_naam' value='<?= $td2 ?>'></div>
                    <div class="table-cell"><input  type='input' name='familie_adres' value='<?= $td3 ?>'></div>
                    <div class="table-cell"><?= $contributie_familie ?></div>
                    <div class="table-cell">
                            <input type='hidden' name='familie_id' value='<?= $td1 ?>'>
                            <a  name='delete_familie' class="input-submit" href="Delete_bevestigen.php?soortdelete=familie&id=<?= $td1 ?>"><img height="20" width="20" src="images/delete.png"></a>
                    </div>
                    <div class="table-cell">
                            <input  type='submit' name='familie_aanpassen' value="Aanpassen" class="input-submit" >
                    </div>
                    <div class="table-cell">
                            <input type='submit' name='familie_bekijken'  value="Bekijken" class="input-submit">
                    </div>
                    <?php

                    if(isset($_GET['familieaanpassen'])){
                        if (isset($_GET['id']) && $_GET['id'] == $td1) {
                            $familieaanpassencheck = $_GET['familieaanpassen'];

                            if ($familieaanpassencheck == "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($familieaanpassencheck == "charnaam") {
                                echo "<p class='error'>Kan alleen letters gebruiken voor de familienaam!</p>";
                            }
                            if ($familieaanpassencheck == "charadres") {
                                echo "<p class='error'>Kan alleen letters en nummers gebruiken voor het adres!</p>";
                            }
                            if ($familieaanpassencheck == "succes") {
                                echo "<p class='succes'>Familie aangepast!</p>";
                            }
                        }
                    }
                    ?>
                </form>
            <?php } ?>
            </div>

    </div>
    <nav class="nav">
        <a href="OverzichtLedenAdministratie.php">Overzicht ledenadministratie</a>
        <a href="SoortenLeden.php">Soorten leden</a>
        <a href="Leeftijdscategorie.php">Leeftijdscategorie</a>
        <a href="BasisbedragContributie.php">Basisbedrag contributie</a>
    </nav>
    <footer class="footer"></footer>


</body>

</html>