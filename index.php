<?php
session_start();
if (isset($_SESSION["benutzer"])) {
    $session_user =  $_SESSION["benutzer"];
}

// include('index.html');
?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerminBuster</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="terminkalender.png" type="image/x-icon">
</head>

<body>
    <div id="container">
        <nav id="leftnav">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="php/loginsite.php">Login</a>
                </li>
                <li><a href="php/dashboard.php"> <?php include('php/sessioncheck.php'); ?> </a>
                    <ul>
                        <li><a href="php/logoutsite.php">Abmelden</a></li>

                    </ul>
                </li>

            </ul>
        </nav>

        <header>
            <h1>TerminBuster - Mehr Termin geht nicht! -</h1>
        </header>

        <main>
            <div id='startwerbung'>
                <p>Wieder den Geburtstag Ihres Kindes vergessen? Muttertag verschlafen? Gestriges Bewerbungsgespräch für nächste Woche eingeplant?</p>
                <p> Wir können Sie zu keinem besseren Menschen machen, aber Ihnen helfen den Eindruck zu erwecken! </p>
            </div>

            <div id="startkonto">
                <p>Erstellen Sie noch heute Ihr kostenloses Konto!</p>
                <a href="php/createaccount.php">
                    <button id='btncreate'>Konto erstellen</button>
                </a>
            </div>
            <div id="startlogin">
                <p>Bereits registriert? Dann einfach einloggen!</p>
                <a href="php/loginsite.php">
                    <button id='btnlogin'>Hier anmelden</button>
                </a>
            </div>

        </main>

        <footer>
            <p>&copy; 2022 By Mohamed Bouygheoussan <a href="https://github.com/Lassopeptid/terminkalender" target="_blank">Github repository</a></p>
        </footer>

    </div>

</body>

</html>