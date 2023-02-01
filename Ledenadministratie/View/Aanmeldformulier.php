<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="center">
        <h4>Aanmelden</h4>
            <form action="../controller.php" method="post">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
                <input type="password" name="wachtwoord" placeholder="Wachtwoord">
                <input type="password" name="wachtwoord_bevestigen" placeholder="Herhaal het wachtwoord">
                <br>
                <br>
                <button type="submit" name="account_aanmaken">Creëer account</button>
                <br>
                <a href="Loginpagina.php">Login</a>
                <br>
                <br>
                <?php

                if (isset($_GET['aanmeldformulier'])) {

                    $signupcheck = $_GET['aanmeldformulier'];

                    if ($signupcheck == "empty") {
                        echo "<p class='error'>Vul alle velden in!</p>";
                    }
                    if ($signupcheck == "char") {
                        echo "<p class='error'>Kunnen alleen letters, nummers, en underscores gebruiken voor een gebruikersnaam!</p>";
                    }
                    if ($signupcheck == "ww6char") {
                        echo "<p class='error'>Wachtwoord moet minstens 6 characters hebben!</p>";
                    }
                    if ($signupcheck == "wwmismatch") {
                        echo "<p class='error'>Wachtwoord en wachtwoord bevestigen komen niet overeen!</p>";
                    }
                    if ($signupcheck == "gebruikersnaamalgebruikt") {
                        echo "<p class='error'>Deze gebruikersnaam is al in gebruik!</p>";
                    }
                    if ($signupcheck == "succes") {
                        echo "<p class='succes'>Account aangemaakt!</p>";
                    }
                }
    ?>
            </form>
    </div>
    
</body>

</html> 