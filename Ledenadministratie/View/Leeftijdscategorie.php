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
    <h3>Leeftijdscategorie</h3>
    <a href="LeeftijdscategorieToevoegen.php" class="btn-toevoegen">Leeftijdscategorie toevoegen</a></button><br><br>
    <div class="table">
      <div class="table-header">
        <div class="table-header-cell">ID</div>
        <div class="table-header-cell">Leeftijdscategorie</div>
        <div class="table-header-cell">Staffel</div>
      </div>

      <?php
      include("../controller.php");
      $leeftijdscategorieën = get_leeftijdscategorieën();
      while ($row = $leeftijdscategorieën->fetch()) {
        $td1 = htmlspecialchars($row['id']);
        $td2 = htmlspecialchars($row['omschrijving']);
        $td3 = htmlspecialchars($row['staffel']);
          ?>
          <form action="../controller.php" method="post" class="table-row">
            <div class="table-cell"><?= $td1 ?></div>
            <div class="table-cell"><input  type='input' name='leeftijdscategorie_omschrijving' value='<?= $td2 ?>'></div>
            <div class="table-cell"><input  type='number' step="0.01" min="0" max="100" onkeydown="return false"
                name='leeftijdscategorie_staffel' value='<?= $td3 ?>'></div>
            <div class="table-cell">
                <input type='hidden' name='leeftijdscategorie_id' value='<?= $td1 ?>'>
                <a  name='delete_familie' class="input-submit" href="Delete_bevestigen.php?soortdelete=leeftijdscategorie&id=<?= $td1 ?>"><img height="20" width="20" src="images/delete.png"></a>
            </div>
            <div class="table-cell">
                <input type='submit' value="Aanpassen" name='leeftijdscategorie_aanpassen' class="input-submit">
            </div>
            <?php
                    if(!isset($_GET['leeftijdscategorieaanpassen'])){

                    } else {
                        if (isset($_GET['id']) && $_GET['id'] === $td1) {
                            $leeftijdscategorieaanpassencheck = $_GET['leeftijdscategorieaanpassen'];

                            if ($leeftijdscategorieaanpassencheck === "empty") {
                                echo "<p class='error'>Vul alle velden in!</p>";
                            }
                            if ($leeftijdscategorieaanpassencheck === "charnaam") {
                                echo "<p class='error'>Kan alleen letters en nummers gebruiken voor de leeftijdscategorie!</p>";
                            }
                            if ($leeftijdscategorieaanpassencheck == "succes") {
                                echo "<p class='succes'>Leeftijdscategorie aangepast!</p>";
                            }
                        }
                    }

                    if (!isset($_GET['delete_error'])) {
                      
                      } else {
                        $deletecheck = $_GET['delete_error'];
                      if (isset($_GET['catid']) && strval($_GET['catid']) === $td1) {
                        if ($deletecheck == "error") {
                          echo "<p class='error'>Kan pas verwijderen als geen enkel familielid in deze categorie valt!</p>";
                        }
                      }
                    }
                    
                    ?>
        </form>
        <?php }?>
    </div class="table">
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