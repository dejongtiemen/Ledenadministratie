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
    <h3>Soorten leden</h3>
    <a href="SoortlidToevoegen.php" class="btn-toevoegen">Soort lid toevoegen</a></button><br><br>
    <div class="table">
      <div class="table-header">
        <div class="table-header-cell">ID</div>
        <div class="table-header-cell">Soort lidmaatschap</div>
        <div class="table-header-cell">Staffel</div>
      </div>

      <?php
      include("../controller.php");
      $soorten_leden = get_soorten_leden();
      while ($row = $soorten_leden->fetch()) {
        $td1 = htmlspecialchars($row['id']);
        $td2 = htmlspecialchars($row['omschrijving']);
        $td3 = htmlspecialchars($row['staffel']);
        if ($td1 == 1) {
          ?>
          <div class="table-row">
            <div class="table-cell"><?= $td1 ?></div>
            <div class="table-cell"><?= $td2 ?></div>
            <div class="table-cell"><?= $td3 ?></div>
          </div>
        <?php } else {
          ?>
          <form action="../controller.php" method="post" class="table-row">
            <div class="table-cell"><?= $td1 ?></div>
            <div class="table-cell"><input  type='input' name='soort_lid_omschrijving' value='<?= $td2 ?>'></div>
            <div class="table-cell"><input  type='number' step="0.01" min="0" max="100" onkeydown="return false"
                name='soort_lid_staffel' value='<?= $td3 ?>'></div>
            <div class="table-cell">
                <input type='hidden' name='soort_lid_id' value='<?= $td1 ?>'>
                <a  name='delete_familie' class="input-submit" href="Delete_bevestigen.php?soortdelete=soortlid&id=<?= $td1 ?>"><img height="20" width="20" src="images/delete.png"></a>
            </div>
            <div class="table-cell">
                <input type='submit' value="Aanpassen" name='soort_lid_aanpassen' class="input-submit">
            </div>
            <?php

                    if(isset($_GET['soortlidaanpassen'])){
                        if (isset($_GET['id']) && $_GET['id'] == $td1) {
                            $soortlidaanpassencheck = $_GET['soortlidaanpassen'];

                            if ($soortlidaanpassencheck == "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($soortlidaanpassencheck == "charnaam") {
                                echo "<p class='error'>Kan alleen letters en nummers gebruiken voor het soort lidmaatschap!</p>";
                            }
                            if ($soortlidaanpassencheck == "succes") {
                                echo "<p class='succes'>Soort lid aangepast!</p>";
                            }
                        }
                    }
                    ?>
        </form>
        <?php }
      } ?>
    </div class="table">
  </div>
  <nav class="nav">
    <a href="OverzichtLedenAdministratie.php">Overzicht ledenadministratie</a>
    <a href="SoortLeden.php">Soorten leden</a>
    <a href="Leeftijdscategorie.php">Leeftijdscategorie</a>
    <a href="BasisbedragContributie.php">Basisbedrag contributie</a>
  </nav>
  <footer class="footer"></footer>


</body>

</html>