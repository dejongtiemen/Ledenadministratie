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
<div class="center2">
        <div class="table">
                <div class="caption">
                <?php
                    if (isset($_GET['soortdelete']) ){
                        $soortdelete = $_GET['soortdelete'];

                        if ($soortdelete == "familie") {
                            echo "<h4>Weet je zeker dat je deze familie en alle bijbehorende familieleden wil verwijderen?</h4>";
                        }
                        if ($soortdelete == "familielid") {
                            echo "<h4>Weet je zeker dat je dit familielid wil verwijderen?</h4>";
                        }
                        if ($soortdelete == "soortlid") {
                            echo "<h4>Weet je zeker dat je dit soort lid wil verwijderen?</h4>";
                        }
                        if ($soortdelete == "leeftijdscategorie") {
                            echo "<h4>Weet je zeker dat je deze leeftijdscategorie wil verwijderen?</h4>";
                        }
                    }
                    if(isset($_GET['id'])){
                        $delete_id = $_GET['id'];
                    }
                ?>
                </div>
                <div class="table-header"></div>
            <form action="../Controller.php" method="post" class="table-row">
                <div class="table-cell">
                <input type='hidden' name='delete_id' value='<?= $delete_id ?>'>
                <input type='hidden' name='delete_soort' value='<?= $soortdelete ?>'>
                    <button type="submit" name="delete" >Verwijderen</button>
                </div>
                <div class="table-cell">
                    <button type="submit" name="cancel_delete">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>