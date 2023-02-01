<?php // login.php
$host = 'localhost'; // eventueel veranderen
$data = 'LOI PHP en Mysql'; // eventueel veranderen
$user = 'root'; // eventueel veranderen
$pass = 'mysql'; // eventueel veranderen
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
$opts =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}

$query = "CREATE TABLE IF NOT EXISTS Familie (
                id smallint NOT NULL AUTO_INCREMENT,
                naam varchar(32) NOT NULL,
                adres varchar(32) NOT NULL,
                PRIMARY kEY (id) 
                )";
$result = $pdo->query($query);

$query = "CREATE TABLE IF NOT EXISTS Soort_lid (
    id smallint NOT NULL AUTO_INCREMENT,
    omschrijving varchar(32) NOT NULL,
    staffel decimal(10,2),	
    PRIMARY kEY (id) 
    )";
$result = $pdo->query($query);


$query = "CREATE TABLE IF NOT EXISTS Familielid (
        id smallint NOT NULL AUTO_INCREMENT,
        naam varchar(32) NOT NULL,
        geboortedatum DATE NOT NULL,
        soort_lid smallint NOT NULL,
        id_familie smallint NOT NULL,
        leeftijdscategorie smallint NOT NULL,
        PRIMARY kEY (id),
        FOREIGN KEY (leeftijdscategorie) REFERENCES Leeftijdscategorie (id),
        FOREIGN KEY (soort_lid) REFERENCES Soort_lid (id),
        FOREIGN KEY (id_familie) REFERENCES Familie (id)
            ON DELETE CASCADE
        )";
$result = $pdo->query($query);

$query = "CREATE TABLE IF NOT EXISTS Boekjaar (
    id smallint NOT NULL AUTO_INCREMENT,
    jaar int NOT NULL UNIQUE,
    PRIMARY kEY (id)
    )";
$result = $pdo->query($query);

$query = "CREATE TABLE IF NOT EXISTS Leeftijdscategorie(
    id smallint AUTO_INCREMENT,
    omschrijving varchar(32),
    staffel decimal(10,2),	
    PRIMARY KEY (ID)
)";
$result = $pdo->query($query);

$query = "CREATE TABLE IF NOT EXISTS Contributie (
    id smallint NOT NULL AUTO_INCREMENT,
    leeftijdscategorie smallint NOT NULL,
    boekjaar smallint NOT NULL,
    soort_lid smallint NOT NULL,
    bedrag int NOT NULL,
    PRIMARY kEY (id),
    FOREIGN KEY (leeftijdscategorie) REFERENCES Leeftijdscategorie (id) ON DELETE CASCADE,
    FOREIGN KEY (soort_lid) REFERENCES Soort_lid (id) ON DELETE CASCADE,
    FOREIGN KEY (boekjaar) REFERENCES Boekjaar (id),
    CONSTRAINT leeftijdscategorie_soortlid UNIQUE (leeftijdscategorie, soort_lid)
    )";
$result = $pdo->query($query);


$query = "CREATE TABLE IF NOT EXISTS Basisbedrag_contributie(
    bedrag smallint NOT NULL,
    PRIMARY KEY (bedrag)
)";
$result = $pdo->query($query);

$date = date("Y");
$query = "INSERT IGNORE INTO Boekjaar(
    id, jaar
) VALUES (
    0, ".$date. "
)";
$result = $pdo->query($query);

$query = "CREATE TABLE IF NOT EXISTS gebruikers(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gebruikersnaam varchar(32) NOT NULL UNIQUE,
    wachtwoord varchar(255) NOT NULL
)";
$result = $pdo->query($query);

$query = "INSERT INTO Leeftijdscategorie(
    omschrijving, staffel
    ) VALUES (
        'Jeugd: jonger dan 8 jaar', 0.5
)";

$query = "INSERT INTO Leeftijdscategorie(
    omschrijving, staffel
    ) VALUES (
        'Aspirant: van 8 tot 13 jaar', 0.6
)";

$query = "INSERT INTO Leeftijdscategorie(
    omschrijving, staffel
    ) VALUES (
        'Junior: van 13 tot 18 jaar', 0.75
)";

$query = "INSERT INTO Leeftijdscategorie(
    omschrijving, staffel
    ) VALUES (
        'Senior: van 18 tot 51', 1
)";

$query = "INSERT INTO Leeftijdscategorie(
    omschrijving, staffel
    ) VALUES (
        'Veteraan: vanaf 51 jaar', 0.55
)";

$query = "INSERT INTO Basisbedrag_contributie(
    bedrag
    ) VALUES (
        100
)";

$query = "INSERT INTO soort_lid(
    bomschrijving, staffel
    ) VALUES (
        'Regulier lid', 1
)";
?>