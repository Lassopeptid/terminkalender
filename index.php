<?php
session_start();
if (isset($_SESSION["benutzer"])) {
    $session_user =  $_SESSION["benutzer"];
}

include('php/header.php');
?>
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

<?php
include('php/footer.php');
?>