<p> Folgende Bedingungen gelten beim Erstellen des Passwortes: <br>
    - Mindestens ein Großbuchstabe <br>
    - Mindestens ein Kleinbuchstabe <br>
    - Mindestens eine Zahl <br>
    - Mindestens ein Sonderzeichen <br>
    - Mindeslänge 8 Zeichen
</p>

<form action="" method="post">
    Vorname: <input type="text" name="vname" required />
    Nachname: <input type="text" name="nname" required />
    Benutzername: <input type="text" name="bname" required />
    Email: <input type="email" name="email" required />

    Passwort: <input type="password" name="pwdErstellen" required />

    <input type="submit" value="Konto erstellen" name="submit" />
</form>

<?php

if (isset($_POST['submit'])) {

    $vname = htmlspecialchars($_POST['vname']);
    $nname = htmlspecialchars($_POST['nname']);
    $bname = htmlspecialchars($_POST['bname']);
    $email = htmlspecialchars($_POST['email']);
    $post_string = $_POST["pwdErstellen"];

    include('connect.php');
    $befehl_benutzer = "SELECT benutzername FROM benutzer";
    $antwort_benutzer = mysqli_query($link, $befehl_benutzer);
    while ($datensatz = mysqli_fetch_array($antwort_benutzer)) {
        if ($datensatz['benutzername'] == $bname) {
            echo '<p style="color:red;">Benutzername bereits vergeben.</p>';
            die;
        }
    }

    // $befehl_benutzerpk = "SELECT benutzer_pk FROM benutzer WHERE benutzername = '$bname'";
    // $antwort_benutzerpk = mysqli_query($link, $befehl_benutzerpk);
    // $data = mysqli_fetch_array($antwort_benutzerpk);
    // $bname_pk = $data['benutzer_pk'];


    $befehl_newuser = "INSERT INTO benutzer(benutzername) VALUES ('$bname')";
    $antwort_newuser = mysqli_query($link, $befehl_newuser);

    $befehl_benutzerpk = "SELECT benutzer_pk FROM benutzer WHERE benutzername = '$bname'";
    $antwort_benutzerpk = mysqli_query($link, $befehl_benutzerpk);
    $data = mysqli_fetch_array($antwort_benutzerpk);
    $bname_pk = $data['benutzer_pk'];

    $befehl_person = "INSERT INTO person(person_fk, nachname, vorname, email) VALUES ('$bname_pk','$nname', '$vname', '$email')";
    $antwort_person = mysqli_query($link, $befehl_person);

    mysqli_close($link);


    include_once('passwordcheck.php');
    passwordcheck($post_string, $bname_pk);
}






// if (isset($_POST["pwdErstellen"])) {

//     $post_string = $_POST["pwdErstellen"];

//     include_once('passwordcheck.php');

//     passwordcheck($post_string, $bname_pk);
// }
