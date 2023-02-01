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
    <h3>Basisbedrag contributie</h3>
    <div class="table">
      <div class="table-header">
        <div class="table-header-cell">Bedrag</div>
      </div>
      <?php
      include("../controller.php");
      $contributie = get_basisbedrag_contributie();
          ?>
          <form action="../controller.php" method="post" class="table-row">
            <div class="table-cell"><input  type='number' min="0" step="1" name='basiscontributie' onkeydown="return false" value='<?= $contributie?>'></div>
            <div class="table-cell">
                <input type='submit' value="Aanpassen" name='basiscontributie_aanpassen' class="input-submit">
            </div>
            <?php

                    if(!isset($_GET['contributieaanpassen'])){

                    } else {
                            $contributieaanpassencheck = $_GET['contributieaanpassen'];
                            if ($contributieaanpassencheck == "succes") {
                                echo "<p class='succes'>Basisbedrag contributie aangepast!</p>";
                            }
                    }
                    ?>
        </form>
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