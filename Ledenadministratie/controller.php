<?php
require("Model/LoginDB.php");
require("Model/Model.php");

//familie toevoegen
if (isset($_POST['familie_naam']) && isset($_POST['adres'])) {
     //controleren of de velden ingevuld zijn
     if (empty(trim($_POST["familie_naam"])) || empty($_POST['adres'])) {
        header("Location: View/FamilieToevoegen.php?familietoevoegen=empty");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z ]+$/', trim($_POST["familie_naam"]))) {
        header("Location: View/FamilieToevoegen.php?familietoevoegen=charnaam");
        exit();
    } elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', trim($_POST["adres"]))) {
        header("Location: View/FamilieToevoegen.php?familietoevoegen=charadres");
        exit();
    } 
    familie_toevoegen();
    header('location: View/FamilieToevoegen.php?familietoevoegen=succes');
    exit;
  }

//account aanmaken
  if (isset($_POST['account_aanmaken'])) {
    //controleren of alle velden zijn ingevud
    if (empty(trim($_POST["gebruikersnaam"])) || empty(trim($_POST["wachtwoord"])) || empty(trim($_POST["wachtwoord_bevestigen"]))) {
        header("Location: View/Aanmeldformulier.php?aanmeldformulier=empty");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["gebruikersnaam"]))) {
        header("Location: View/Aanmeldformulier.php?aanmeldformulier=char");
        exit();
        //controleren of het wachtwoord lang genoeg is
    } elseif (strlen(trim($_POST["wachtwoord"])) < 6) {
        header("Location: View/Aanmeldformulier.php?aanmeldformulier=ww6char");
        exit();
    } else {
        //controleren of wachtwoord en wachtwoord bevestigen overeen komen
        $bevestig_wachtwoord = trim($_POST["wachtwoord_bevestigen"]);
        if (trim($_POST["wachtwoord"]) != trim($_POST["wachtwoord_bevestigen"])) {
            header("Location: View/Aanmeldformulier.php?aanmeldformulier=wwmismatch");
            exit;
        }
        //controleren of de gebruikersnaam nog niet in  gebruik is
        $result = gebruikersnaam_controleren();
        if ($result->rowCount() == 1) {
            header("Location: View/Aanmeldformulier.php?aanmeldformulier=gebruikersnaamalgebruikt");
            exit;
        }
        //account aanmaken
        account_aanmaken();
        header('Location: View/Aanmeldformulier.php?aanmeldformulier=succes');
        exit;
    }
}

//familielid bekijken
if (isset($_POST['familie_bekijken'])){
    session_start();
    $_SESSION['familie_id'] = $_POST['familie_id'];
    $_SESSION['familie_naam'] = $_POST['familie_naam'];
    header('location: View/OverzichtFamilie.php');
    exit;
}

//familielid toevoegen
if(isset($_POST['familielid_toevoegen']) && isset($_POST['familielid_naam']) && isset($_POST['geboortedatum']) && isset($_POST['soort_lid']) && isset($_POST['leeftijdscategorie'])){
    //controleren of de velden ingevuld zijn
    if (empty(trim($_POST["familielid_naam"])) || empty($_POST['geboortedatum'])) {
        header("Location: View/FamilielidToevoegen.php?familielidtoevoegen=empty");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["familielid_naam"]))) {
        header("Location: View/FamilielidToevoegen.php?familielidtoevoegen=charnaam");
        exit();
    } 
    familielid_toevoegen();
    header('location: View/FamilielidToevoegen.php?familielidtoevoegen=succes');
    exit;
}

//soort lid aanpassen
if(isset($_POST['soort_lid_aanpassen']) && isset($_POST['soort_lid_id']) && isset($_POST['soort_lid_omschrijving']) && isset($_POST['soort_lid_staffel'])){
    $id = $_POST['soort_lid_id'];
    //controleren of de velden ingevuld zijn
        if (empty(trim($_POST["soort_lid_omschrijving"]))) {
            header("Location: View/SoortenLeden.php?soortlidaanpassen=empty&id=$id");
            exit();
            //controleren of de juiste characters zijn gebruikt
        } elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', trim($_POST["soort_lid_omschrijving"]))) {
            header("Location: View/SoortenLeden.php?soortlidaanpassen=charnaam&id=$id");
            exit();
        } 
    soort_lid_aanpassen();
    header("location: View/SoortenLeden.php?soortlidaanpassen=succes&id=$id");
    exit;
}

//soort lid verwijderen
if(isset($_POST['soort_lid_verwijderen_y']) && isset($_POST['soort_lid_id'])){
    familielid_soort_lid_naar_default($_POST['soort_lid_id']);
    soort_lid_verwijderen();
    header('location: View/SoortenLeden.php');
    exit;
}

// familie aanpassen
if (isset($_POST['familie_aanpassen']) && isset($_POST['familie_id']) && isset($_POST['familie_naam']) && isset($_POST['familie_adres'])) {
    $id = $_POST['familie_id'];
//controleren of de velden ingevuld zijn
    if (empty(trim($_POST["familie_naam"])) || empty(trim($_POST["familie_adres"]))) {
        header("Location: View/OverzichtLedenadministratie.php?familieaanpassen=empty&id=$id");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z ]+$/', trim($_POST["familie_naam"]))) {
        header("Location: View/OverzichtLedenadministratie.php?familieaanpassen=charnaam&id=$id");
        exit();
    } elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', trim($_POST["familie_adres"]))) {
        header("Location: View/OverzichtLedenadministratie.php?familieaanpassen=charadres&id=$id");
        exit();
        //familie aanpassen
    }else {
        familie_aanpassen();
        header("Location: View/OverzichtLedenadministratie.php?familieaanpassen=succes&id=$id");
        exit;
    }
}

//familielid aanpassen
if(isset($_POST['familielid_aanpassen']) && isset($_POST['familielid_id']) && isset($_POST['familielid_naam']) && isset($_POST['geboortedatum']) && isset($_POST['soort_lid']) && isset($_POST['leeftijdscategorie'])){
    $id = $_POST['familielid_id'];
//controleren of de velden ingevuld zijn
    if (empty(trim($_POST["familielid_naam"])) || empty(trim($_POST["geboortedatum"]))) {
        header("Location: View/OverzichtFamilie.php?familielidaanpassen=empty&id=$id");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["familielid_naam"]))) {
        header("Location: View/OverzichtFamilie.php?familielidaanpassen=charnaam&id=$id");
        exit();
    } 
    familielid_aanpassen();
    header("location: View/OverzichtFamilie.php?familielidaanpassen=succes&id=$id");
    exit;
}


//soort lid toevoegen
if (isset($_POST['soort_lid_toevoegen']) && isset($_POST['soort_lid_beschrijving']) && isset($_POST['soort_lid_staffel'])){
    //controleren of de velden ingevuld zijn
        if (empty(trim($_POST["soort_lid_beschrijving"]))) {
            header("Location: View/SoortLidToevoegen.php?soortlidtoevoegen=empty");
            exit();
            //controleren of de juiste characters zijn gebruikt
        } elseif (!preg_match('/^[a-zA-Z0-9 -]+$/', trim($_POST["soort_lid_beschrijving"]))) {
            header("Location: View/SoortLidToevoegen.php?soortlidtoevoegen=charnaam");
            exit();
        } 
    soort_lid_toevoegen();
    contributie_updaten_soort_lid_toevoegen();
    header("location: View/SoortLidToevoegen.php?soortlidtoevoegen=succes");
    exit;
}

//leeftijdscategorie toegvoegen
if (isset($_POST['leeftijdscategorie_toevoegen']) && isset($_POST['leeftijdscategorie_omschrijving']) && isset($_POST['leeftijdscategorie_staffel'])){
    //controleren of de velden ingevuld zijn
    if (empty(trim($_POST["leeftijdscategorie_omschrijving"]))) {
        header("Location: View/LeeftijdscategorieToevoegen.php?leeftijdscategorietoevoegen=empty");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z0-9 -:]+$/', trim($_POST["leeftijdscategorie_omschrijving"]))) {
        header("Location: View/LeeftijdscategorieToevoegen.php?leeftijdscategorietoevoegen=charnaam");
        exit();
    } 
    leeftijdscategorie_toevoegen();
    contributie_updaten_leeftijdscategorie_toevoegen();
    header("Location: View/LeeftijdscategorieToevoegen.php?leeftijdscategorietoevoegen=succes");
    exit;
}


//leeftijdscategorie aanpassen
if (isset($_POST['leeftijdscategorie_aanpassen'])&& isset($_POST['leeftijdscategorie_id']) && isset($_POST['leeftijdscategorie_omschrijving']) && isset($_POST['leeftijdscategorie_staffel'])){
    $id = $_POST['leeftijdscategorie_id'];
//controleren of de velden ingevuld zijn
    if (empty(trim($_POST["leeftijdscategorie_omschrijving"]))) {
        header("Location: View/Leeftijdscategorie.php?leeftijdscategorieaanpassen=empty&id=$id");
        exit();
        //controleren of de juiste characters zijn gebruikt
    } elseif (!preg_match('/^[a-zA-Z0-9 :]+$/', trim($_POST["leeftijdscategorie_omschrijving"]))) {
        header("Location: View/Leeftijdscategorie.php?leeftijdscategorieaanpassen=charnaam&id=$id");
        exit();
    } 
    leeftijdscategorie_aanpassen();
    contibutie_updaten();
    header("Location: View/Leeftijdscategorie.php?leeftijdscategorieaanpassen=succes&id=$id");
    exit;
}

//basiscontributie aanpassen
if(isset($_POST['basiscontributie_aanpassen']) && isset($_POST['basiscontributie'])){
    basisbedrag_contributie_aanpassen();
    contibutie_updaten();
    header('location: View/BasisbedragContributie.php?contributieaanpassen=succes');
    exit;
}

 //uitloggen
if(isset($_POST['logout'])){
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: View/Loginpagina.php");
    exit;
}

//delete handelen
if (isset($_POST['delete'])) {

    switch ($_POST['delete_soort']) {
        case "familie":
            familie_verwijderen();
            header('location: View/OverzichtLedenadministratie.php');
            exit;
        case "familielid":
            familielid_verwijderen();
            header('location: View/OverzichtFamilie.php');
            exit;
        case "soortlid":
            familielid_soort_lid_naar_default($_POST['delete_id']);
            soort_lid_verwijderen();
            header('location: View/SoortenLeden.php');
            exit;
        case "leeftijdscategorie":
            if($bool = isfamilieleden_in_leeftijdscategorie()){
                header("location: View/Leeftijdscategorie.php?delete_error=error&catid=".$_POST['delete_id']."");
            } else {
                leeftijdscategorie_verwijderen();
                header('location: View/Leeftijdscategorie.php');
                exit;
            }
    }
}

//cancel delete handelen
if (isset($_POST['cancel_delete'])) {

    switch ($_POST['delete_soort']) {
        case "familie":
            header('location: View/OverzichtLedenadministratie.php');
            exit;
        case "familielid":
            header('location: View/OverzichtFamilie.php');
            exit;
        case "soortlid":
            header('location: View/SoortenLeden.php');
            exit;
        case "leeftijdscategorie":
            header('location: View/Leeftijdscategorie.php');
            exit;
    }
}

?>