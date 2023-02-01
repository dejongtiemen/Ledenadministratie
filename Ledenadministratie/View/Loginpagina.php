<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="center">
        <h4>LOGIN</h4>
        <form action="../Login.php" method="post">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
                <input type="password" name="wachtwoord" placeholder="Wachtwoord">
                <br>
                <button type="submit" name="inloggen">Login</button>
                <br>
                <a href="Aanmeldformulier.php">Maak een account aan</a>
                <?php

    if(!isset($_GET['login'])){

    } else {
        $logincheck = $_GET['login'];

        if($logincheck == "empty"){
            echo "<p class='error'>Vul alle velden in!</p>";
        }
        if($logincheck == "verkeerd"){
            echo "<p class='error'>De combinatie password en gebruikersnaam is verkeerd!</p>";
        }
    }
    ?>
            </form>
    </div>
</body>

</html>