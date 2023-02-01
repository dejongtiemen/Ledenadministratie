<?php
require("Model/LoginDB.php");
require("Model/Model.php");

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('location: /View/OverzichtLedenadministratie.php');
    exit;
} else {
    header('location: View/Loginpagina.php');
    exit;
}



    

?>