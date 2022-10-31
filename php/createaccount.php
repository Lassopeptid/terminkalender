<?php
session_start();
if (isset($_SESSION["benutzer"])) {
    $session_user =  $_SESSION["benutzer"];
}

include('headersub.php');
?>

<div id="divregeln">
    <p> Folgende Bedingungen gelten beim Erstellen des Passwortes: <br><br>
        - Mindestens ein Großbuchstabe <br>
        - Mindestens ein Kleinbuchstabe <br>
        - Mindestens eine Zahl <br>
        - Mindestens ein Sonderzeichen <br>
        - Mindeslänge 8 Zeichen
    </p>
</div>


<form action="" method="post">
    <label for="vnamee">Vorname:</label>
    <input type="text" id="vnamee" name="vname" required />

    <label for="nnamee"> Nachname:</label>
    <input type="text" id="nnamee" name="nname" required />

    <label for="bnamee">Benutzername: </label>
    <input type="text" id="bnamee" name="bname" required />

    <label for="emaile">Email: </label>
    <input type="email" id="emaile" name="email" required />

    <label for="pwde">Passwort: </label>
    <input type="password" id="pwde" name="pwdErstellen" required />

    <input type="submit" value="Konto erstellen" name="submit" />
</form>

<?php

if (isset($_POST['submit'])) {

    $vname = htmlspecialchars($_POST['vname']);
    $nname = htmlspecialchars($_POST['nname']);
    $bname = htmlspecialchars($_POST['bname']);
    $email = htmlspecialchars($_POST['email']);
    $post_string = $_POST["pwdErstellen"];

    include_once('passwordcheck.php');
    // passwordcheck($post_string);

    include('connect.php');
    $befehl_benutzer = "SELECT benutzername FROM benutzer";
    $antwort_benutzer = mysqli_query($link, $befehl_benutzer);
    while ($datensatz = mysqli_fetch_array($antwort_benutzer)) {
        if ($datensatz['benutzername'] == $bname) {
            echo '<p id="bnnameefalsch">Benutzername bereits vergeben.</p>';
            die;
        }
    }
    if ($pwd_ok[0] == 1) {
        $hashed_pwd = $pwd_ok[1];
        // include('connect.php');
        $befehl_newuser = "INSERT INTO benutzer(benutzername) VALUES ('$bname')";
        $antwort_newuser = mysqli_query($link, $befehl_newuser);

        $befehl_benutzerpk = "SELECT benutzer_pk FROM benutzer WHERE benutzername = '$bname'";
        $antwort_benutzerpk = mysqli_query($link, $befehl_benutzerpk);
        $data = mysqli_fetch_array($antwort_benutzerpk);
        $bname_pk = $data['benutzer_pk'];

        $befehl_person = "INSERT INTO person(person_fk, nachname, vorname, email) VALUES ('$bname_pk','$nname', '$vname', '$email')";
        $antwort_person = mysqli_query($link, $befehl_person);

        // mysqli_close($link);




        $befehl_pwd = "INSERT INTO anmeldung(benutzer_fk, passwort) VALUES ('$bname_pk', '$hashed_pwd')";
        mysqli_query($link, $befehl_pwd);
        mysqli_close($link);
        header('Location: loginsite.php');
        die;
    }
}

include('footer.php');
?>