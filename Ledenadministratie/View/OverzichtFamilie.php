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
<?php
  include("../controller.php");
  $familie_id = $_SESSION['familie_id'];
  $familie_naam = $_SESSION['familie_naam'];
  $huidige_familie = get_familie($familie_id);
  ?>
  <header class="header">
    <h2>Ledenadministratie<h2>
    <form action="../controller.php" method="post" class="btn-toevoegen">
            <button  name="logout">Log out</button>
        </form>
  </header>
  <div class="content">
    <h3>Overzicht familie <?= $familie_naam ?></h3>
    <a href="FamilielidToevoegen.php" class="btn-toevoegen">Familielid toevoegen</a></button><br><br>

<div class="table">
    <div class="table-header">
    <div class="table-header-cell">id</div>
        <div class="table-header-cell">Naam</div>
        <div class="table-header-cell">Geboortedatum</div>
        <div class="table-header-cell">Soort lid</div>
        <div class="table-header-cell">Leeftijdscategorie</div>
        <div class="table-header-cell">Contributie</div>
    </div>
    <?php
    while ($row = $huidige_familie->fetch()) {
        $td1 = htmlspecialchars($row['id']);
        $td2 = htmlspecialchars($row['naam']);
        $td3 = htmlspecialchars($row['geboortedatum']);
        $td4 = htmlspecialchars($row['soort_lid']);
        $leeftijdscategorie_id = htmlspecialchars($row['leeftijdscategorie']);
        $contributie = get_contributie_familielid($td4, $leeftijdscategorie_id);
    ?>
    
      <form action="../controller.php" method="post" class="table-row">
         <div class="table-cell"><?= $td1 ?></div>
          <div class="table-cell"><input  type='input' name='familielid_naam' value='<?= $td2 ?>'></div>
          <div class="table-cell"><input  type='date' name='geboortedatum' value='<?= $td3 ?>'></div>
          <div class="table-cell"><select type="input" id="soort_lid" name="soort_lid" >
              <?php
              $soorten_leden = get_soorten_leden();
              while ($row2 = $soorten_leden->fetch()) {
                $td5 = htmlspecialchars($row2['id']);
                $td6 = htmlspecialchars($row2['omschrijving']);
                if ($td5 == $td4) {
                  ?>
                  <option selected="selected" value="<?= $td5 ?>"><?= $td6 ?></option>
              <?php } else { ?>
                <option value="<?= $td5 ?>"><?= $td6 ?></option>
              <?php }
              }?>
            </select></div>
            <div class="table-cell"><select type="input" id="leeftijdscategorie" name="leeftijdscategorie" >
              <?php
              $leeftijdscategotieën = get_leeftijdscategorieën();
              while ($row2 = $leeftijdscategotieën->fetch()) {
                $td5 = htmlspecialchars($row2['id']);
                $td6 = htmlspecialchars($row2['omschrijving']);
                if ($td5 == $leeftijdscategorie_id) {
                  ?>
                  <option selected="selected" value="<?= $td5 ?>"><?= $td6 ?></option>
              <?php } else { ?>
                <option value="<?= $td5 ?>"><?= $td6 ?></option>
              <?php }
              } ?>
            </select></div>
            <div class="table-cell"><?= $contributie ?></div>
          <div class="table-cell">
              <input type='hidden' name='familielid_id' value='<?= $td1 ?>'>
              <a  name='delete_familie' class="input-submit" href="Delete_bevestigen.php?soortdelete=familielid&id=<?= $td1 ?>"><img height="20" width="20" src="images/delete.png"></a>
          </div>
          <div class="table-cell">
            <input  type='submit' name='familielid_aanpassen' value="Aanpassen" class="input-submit">
          </div>
          <?php

                    if(isset($_GET['familielidaanpassen'])){
                        if (isset($_GET['id']) && $_GET['id'] == $td1) {
                            $familielidaanpassencheck = $_GET['familielidaanpassen'];

                            if ($familielidaanpassencheck == "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($familielidaanpassencheck == "charnaam") {
                                echo "<p class='error'>Kan alleen letters gebruiken voor de familienaam!</p>";
                            }
                            if ($familielidaanpassencheck == "succes") {
                                echo "<p class='succes'>Familielid aangepast!</p>";
                            }
                        }
                    }
                    ?>
              </form>
<?php }?>
</div>
              </div>
  <nav class="nav">
    <a href="OverzichtLedenadministratie.php">Overzicht ledenadministratie</a>
    <a href="SoortenLeden.php">Soorten leden</a>
    <a href="Leeftijdscategorie.php">Leeftijdscategorie</a>
    <a href="BasisbedragContributie.php">Basisbedrag contributie</a>
  </nav>
  <footer class="footer"></footer>


</body>

</html>