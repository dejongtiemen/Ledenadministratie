<?php
use LDAP\Result;


function familie_toevoegen()
{
    global $pdo;
    $id = 0;
    $familie_naam = trim($_POST['familie_naam']);
    $adres = trim($_POST['adres']);

    $query = "INSERT INTO familie (id, naam, adres) VALUES " .
        "('$id', '$familie_naam', '$adres')";

    $result = $pdo->query($query);
}

function familie_aanpassen()
{
    global $pdo;
    $familie_naam = trim($_POST['familie_naam']);
    $familie_adres = trim($_POST['familie_adres']);
    $id = trim($_POST['familie_id']);
    $query = "UPDATE familie
                    SET naam = '$familie_naam', adres = '$familie_adres'
                        WHERE id = '$id'";

    $result = $pdo->query($query);
}

function familie_verwijderen(){
    global $pdo;
    $familie_id = $_POST['delete_id'];
    $query = "DELETE FROM familie WHERE id=$familie_id";

    $result = $pdo->query($query);
}

function get_families()
{
    global $pdo;
    $query = "SELECT * FROM familie";
    $result = $pdo->query($query);
    return $result;
}


function get_familie($id)
{
    global $pdo;
    $query = "SELECT id, naam, geboortedatum, soort_lid, leeftijdscategorie  FROM familielid WHERE id_familie='$id'";
    $result = $pdo->query($query);
    //$artikel = $result->fetch();
    return $result;
}

function familielid_toevoegen()
{
    global $pdo;
    $familielid_naam = trim($_POST['familielid_naam']);
    $geboortedatum = trim($_POST['geboortedatum']);
    $soort_lid = get_soort_lid_id($_POST['soort_lid']);
    $leeftijdscategorie = $_POST['leeftijdscategorie'];
    session_start();
    $familie_id = $_SESSION['familie_id'];

    $query = "INSERT INTO familielid (naam, geboortedatum, soort_lid, id_familie, leeftijdscategorie) VALUES " .
        "('$familielid_naam', '$geboortedatum', '$soort_lid', '$familie_id', '$leeftijdscategorie')";

    $result = $pdo->query($query);
}

function familielid_aanpassen()
{
    global $pdo;
    $familielid_naam = trim($_POST['familielid_naam']);
    $geboortedatum = $_POST['geboortedatum'];
    $soort_lid = $_POST['soort_lid'];
    $leeftijdscategorie = $_POST['leeftijdscategorie'];
    $id = $_POST['familielid_id'];
    $query = "UPDATE familielid
                    SET naam = '$familielid_naam', geboortedatum = '$geboortedatum', soort_lid = '$soort_lid', leeftijdscategorie = '$leeftijdscategorie'
                        WHERE id = '$id'";

    $result = $pdo->query($query);
}

function familielid_verwijderen(){
    global $pdo;
    $familielid_id = $_POST['delete_id'];
    $query = "DELETE FROM familielid WHERE id=$familielid_id";

    $result = $pdo->query($query);
}

function get_soorten_leden()
{
    global $pdo;
    $query = "SELECT * FROM soort_lid";
    $result = $pdo->query($query);
    return $result;
}

function get_soort_lid_id($omschrijving)
{
    global $pdo;
    $query = "SELECT id  FROM soort_lid WHERE omschrijving='$omschrijving'";
    $result = $pdo->query($query);
    $soort_lid_arr = $result->fetch();
    $soort_lid = htmlspecialchars($soort_lid_arr['id']);
    return $soort_lid;
}

function get_soort_lid_omschrijving($id)
{
    global $pdo;
    $query = "SELECT omschrijving  FROM soort_lid WHERE id='$id'";
    $result = $pdo->query($query);
    $soort_lid_arr = $result->fetch();
    $soort_lid = htmlspecialchars($soort_lid_arr['omschrijving']);
    return $soort_lid;
}

function soort_lid_aanpassen()
{
    global $pdo;
    $soort_lid_omschrijving = trim($_POST['soort_lid_omschrijving']);
    $soort_lid_staffel = $_POST['soort_lid_staffel'];
    $id = $_POST['soort_lid_id'];
    $query = "UPDATE soort_lid
                    SET omschrijving = '$soort_lid_omschrijving', staffel = '$soort_lid_staffel'
                        WHERE id = '$id'";

    $result = $pdo->query($query);
}

function soort_lid_toevoegen(){
    global $pdo;
    $soort_lid_beschrijving = trim($_POST['soort_lid_beschrijving']);
    $soort_lid_staffel = $_POST['soort_lid_staffel'];

    $query = "INSERT INTO soort_lid ( omschrijving, staffel) VALUES " .
        "('$soort_lid_beschrijving', '$soort_lid_staffel')";

    $result = $pdo->query($query);
}

function familielid_soort_lid_naar_default($id)
{
    global $pdo;
    $query = "UPDATE familielid
        SET soort_lid = 1
            WHERE soort_lid = '$id'";

    $result = $pdo->query($query);
}

function soort_lid_verwijderen(){
    global $pdo;
    $id = $_POST['delete_id'];
    $query = "DELETE FROM soort_lid WHERE id = $id";

    $result = $pdo->query($query);
}

function get_leeftijdscategorieën()
{
    global $pdo;
    $query = "SELECT * FROM leeftijdscategorie";
    $result = $pdo->query($query);
    return $result;
}

function get_leeftijdscategorie_omschrijving($id){
    global $pdo;
    $query = "SELECT omschrijving  FROM leeftijdscategorie WHERE id='$id'";
    $result = $pdo->query($query);
    $leeftijdscategorie_arr = $result->fetch();
    $leeftijdscategorie_lid = htmlspecialchars($leeftijdscategorie_arr['omschrijving']);
    return $leeftijdscategorie_lid;
}

function leeftijdscategorie_verwijderen(){
    global $pdo;
    $id = $_POST['delete_id'];
    $query = "DELETE FROM leeftijdscategorie WHERE id = $id";

    $result = $pdo->query($query);
}

function leeftijdscategorie_aanpassen()
{
    global $pdo;
    $leeftijdscategorie_omschrijving = trim($_POST['leeftijdscategorie_omschrijving']);
    $leeftijdscategorie_staffel = $_POST['leeftijdscategorie_staffel'];
    $id = $_POST['leeftijdscategorie_id'];
    $query = "UPDATE leeftijdscategorie
                    SET omschrijving = '$leeftijdscategorie_omschrijving', staffel = '$leeftijdscategorie_staffel'
                        WHERE id = '$id'";

    $result = $pdo->query($query);
}

function leeftijdscategorie_toevoegen(){
    global $pdo;
    $leeftijdscategorie_omschrijving = trim($_POST['leeftijdscategorie_omschrijving']);
    $leeftijdscategorie_staffel = $_POST['leeftijdscategorie_staffel'];

    $query = "INSERT INTO leeftijdscategorie ( omschrijving, staffel) VALUES " .
        "('$leeftijdscategorie_omschrijving', '$leeftijdscategorie_staffel')";

    $result = $pdo->query($query);
}

function get_basisbedrag_contributie()
{
    global $pdo;
    $query = "SELECT bedrag  FROM basisbedrag_contributie";
    $result = $pdo->query($query);
    $contributie_arr = $result->fetch();
    $contributie = htmlspecialchars($contributie_arr['bedrag']);
    return $contributie;
}

function basisbedrag_contributie_aanpassen(){
    global $pdo;
    $bedrag = $_POST['basiscontributie'];
    $query = "UPDATE basisbedrag_contributie
                    SET bedrag = '$bedrag'
                        ";

    $result = $pdo->query($query);
}

function get_boekjaar(){
    global $pdo;
    $query = "SELECT id  FROM boekjaar";
    $result = $pdo->query($query);
    $boekjaar_arr = $result->fetch();
    $boekjaar = htmlspecialchars($boekjaar_arr['id']);
    return $boekjaar;
}

function contributie_berekenen(){
    global $pdo;
    $soorten_leden = get_soorten_leden();
    $leeftijdscategorieën = get_leeftijdscategorieën();
    $basisbedrag_contributie = get_basisbedrag_contributie();
    $boekjaar = get_boekjaar();
    while ($row1 = $soorten_leden->fetch()){
        $soort_lid_id = htmlspecialchars($row1['id']);
        $soort_lid_staffel = htmlspecialchars($row1['staffel']);

        while($row2 = $leeftijdscategorieën->fetch()){
        $leeftijdscategorie_id = htmlspecialchars($row2['id']);
        $leeftijdscategorie_staffel = htmlspecialchars($row2['staffel']);

        $bedrag = $basisbedrag_contributie * $soort_lid_staffel * $leeftijdscategorie_staffel;

        $query = "INSERT INTO contributie (leeftijdscategorie, boekjaar, soort_lid, bedrag) 
                    VALUES (
                        '$leeftijdscategorie_id', '$boekjaar', '$soort_lid_id', '$bedrag'
                    )";

        $result = $pdo->query($query);
        }
    }
}

function contibutie_updaten(){
    global $pdo;
    $soorten_leden = get_soorten_leden();
    $leeftijdscategorieën = get_leeftijdscategorieën();
    $leeftijdscategorieën_arr = $leeftijdscategorieën->fetchAll();
    $soorten_leden_arr = $soorten_leden->fetchAll();
    $basisbedrag_contributie = get_basisbedrag_contributie();
    foreach ($soorten_leden_arr as $soort_lid){
        $soort_lid_id = htmlspecialchars($soort_lid['id']);
        $soort_lid_staffel = htmlspecialchars($soort_lid['staffel']);
       
        foreach($leeftijdscategorieën_arr as $leeftijdscategorie){
        $leeftijdscategorie_id = htmlspecialchars($leeftijdscategorie['id']);
        $leeftijdscategorie_staffel = htmlspecialchars($leeftijdscategorie['staffel']);
        
        $bedrag = $basisbedrag_contributie * $soort_lid_staffel * $leeftijdscategorie_staffel;

        $query = "UPDATE contributie 
                    SET bedrag = '$bedrag'
                        WHERE leeftijdscategorie = '$leeftijdscategorie_id'
                        AND soort_lid = '$soort_lid_id'
                    ";

        $result = $pdo->query($query);

            
           
        }
    }
}

function contributie_updaten_leeftijdscategorie_toevoegen()
{
    global $pdo;
    $query = " SELECT id, staffel 
                FROM leeftijdscategorie
                    WHERE id = (SELECT MAX(id) FROM leeftijdscategorie)
    ";
    $result = $pdo->query($query);
    $leeftijdscategorie_arr = $result->fetch();
    $leeftijdscategorie_id = htmlspecialchars($leeftijdscategorie_arr['id']);
    $leeftijdscategorie_staffel = htmlspecialchars($leeftijdscategorie_arr['staffel']);
    $soorten_leden = get_soorten_leden();
    $basisbedrag_contributie = get_basisbedrag_contributie();
    $boekjaar = get_boekjaar();

    while ($row1 = $soorten_leden->fetch()) {
        $soort_lid_id = htmlspecialchars($row1['id']);
        $soort_lid_staffel = htmlspecialchars($row1['staffel']);

        $bedrag = $basisbedrag_contributie * $soort_lid_staffel * $leeftijdscategorie_staffel;

        $query = "INSERT INTO contributie (leeftijdscategorie, boekjaar, soort_lid, bedrag) 
        VALUES (
            '$leeftijdscategorie_id', '$boekjaar', '$soort_lid_id', '$bedrag'
        )";

        $result = $pdo->query($query);
    }
}

function contributie_updaten_soort_lid_toevoegen(){
    global $pdo;
    $query = " SELECT id, staffel 
                FROM soort_lid
                    WHERE id = (SELECT MAX(id) FROM soort_lid)
    ";
    $result = $pdo->query($query);
    $soort_lid_arr = $result->fetch();
    $soort_lid_id = htmlspecialchars($soort_lid_arr['id']);
    $soort_lid_staffel = htmlspecialchars($soort_lid_arr['staffel']);
    $leeftijdscategorieën = get_leeftijdscategorieën();
    $basisbedrag_contributie = get_basisbedrag_contributie();
    $boekjaar = get_boekjaar();

    while ($row1 = $leeftijdscategorieën->fetch()) {
        $leeftijdscategorie_id = htmlspecialchars($row1['id']);
        $leeftijdscategorie_staffel = htmlspecialchars($row1['staffel']);

        $bedrag = $basisbedrag_contributie * $soort_lid_staffel * $leeftijdscategorie_staffel;

        $query = "INSERT INTO contributie (leeftijdscategorie, boekjaar, soort_lid, bedrag) 
        VALUES (
            '$leeftijdscategorie_id', '$boekjaar', '$soort_lid_id', '$bedrag'
        )";

        $result = $pdo->query($query);
    }
}


function get_contributie_familielid($soort_lid_id, $leeftijdscategorie_id){
    global $pdo;
    $query = "SELECT bedrag FROM contributie
    WHERE leeftijdscategorie = '$leeftijdscategorie_id'
                        AND soort_lid = '$soort_lid_id'";
    $result = $pdo->query($query);
    $bedrag_arr = $result->fetch();
    $bedrag = htmlspecialchars($bedrag_arr['bedrag']);
    return $bedrag;
}

function gebruikersnaam_controleren(){
    global $pdo;
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $query = "SELECT id FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaam'";
    $result = $pdo->query($query);
    return $result;
}

function account_aanmaken(){
    global $pdo;
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $wachtwoord = trim($_POST['wachtwoord']);
    $wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT); 
    $query = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord) 
                VALUES 
                    ('$gebruikersnaam', '$wachtwoord_hash')";
    $result = $pdo->query($query);
    return $result;
}

function inloggegevens_ophalen(){
    global $pdo;
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $query = "SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaam'";
    $result = $pdo->query($query);
    return $result;
}

function isfamilieleden_in_leeftijdscategorie(){
    global $pdo;
    $id = $_POST['delete_id'];
    $query = "SELECT id FROM familielid WHERE leeftijdscategorie = '$id'";
    $result = $pdo->query($query);
    if ($result->rowCount() > 0){
        return true;
    } else {
        return false;
    }
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

?>