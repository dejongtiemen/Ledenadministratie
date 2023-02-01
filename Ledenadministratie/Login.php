<?php
require("Model/LoginDB.php");
require("Model/Model.php");

if (isset($_POST['inloggen'])) {
    //controleren of alle velden zijn ingevuld
    if(empty(trim($_POST['gebruikersnaam'])) || empty(trim($_POST['wachtwoord']))){
        header("Location: View/LoginPagina.php?login=empty");
        exit();
    } else {
        $result = inloggegevens_ophalen();
        if ($result->rowCount() == 1) {
            if ($row = $result->fetch()) {
                $id = $row["id"];
                $gebruikersnaam = $row['gebruikersnaam'];
                $wachtwoord = $_POST['wachtwoord'];
                $hashed_wachtwoord = $row['wachtwoord'];
                if (password_verify($wachtwoord, $hashed_wachtwoord)) {
                    
                    session_start();
    
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["gebruikersnaam"] = $gebruikersnaam;
    
                    header('location: View/OverzichtLedenadministratie.php');
                    exit;
                }
            }
        } else {
            header("Location: View/LoginPagina.php?login=verkeerd");
            exit();
        }
    }
}

?>