<?php
session_start();
?>

<form action="" method="post">

    Benutzername: <input type="text" name="user_log" required />
    Passwort: <input type="password" name="pwd_log" required />

    <input type="submit" value="Anmelden" name="submit" />
</form>

<?php


if (isset($_POST['user_log']) && isset($_POST['pwd_log'])) {

    $user_log = htmlspecialchars($_POST['user_log']);
    $pwd_log = $_POST['pwd_log'];

    include('connect.php');
    $befehl_user = "SELECT benutzername FROM benutzer";
    $antwort_user = mysqli_query($link, $befehl_user);

    $befehl_max = "SELECT MAX(benutzer_pk) FROM benutzer";
    $antwort_max = mysqli_query($link, $befehl_max);
    $data_max = mysqli_fetch_array($antwort_max);
    $max_benutzerpk = $data_max[0];
    // echo '<br>'.$max_benutzerpk.'<br>';

    $befehl_maxuser = "SELECT benutzername FROM benutzer WHERE benutzer_pk = '$max_benutzerpk'";
    $antwort_maxuser = mysqli_query($link, $befehl_maxuser);
    $data_maxuser = mysqli_fetch_array($antwort_maxuser);
    $max_benutzername = $data_maxuser['benutzername'];
    // echo '<br>'.$max_benutzername.'<br>';

    while ($datensatz = mysqli_fetch_array($antwort_user)) {

        if ($datensatz['benutzername'] == $user_log) {
            // echo 'Benutzername ist in der Datenbank';
            $befehl_benutzerpk = "SELECT benutzer_pk FROM benutzer WHERE benutzername = '$user_log'";
            $antwort_benutzerpk = mysqli_query($link, $befehl_benutzerpk);
            $data = mysqli_fetch_array($antwort_benutzerpk);
            $user_benutzerpk = $data['benutzer_pk'];
            // echo '<br>' . $user_benutzerpk;

            $befehl_pwd = "SELECT passwort FROM anmeldung WHERE benutzer_fk = '$user_benutzerpk'";
            $antwort_pwd = mysqli_query($link, $befehl_pwd);
            $data_pwd = mysqli_fetch_array($antwort_pwd);
            $user_pwd = $data_pwd['passwort'];
            // echo '<br>' . $user_pwd . '<br>';

            if (password_verify($pwd_log, $user_pwd)) {

                $_SESSION['Login aktiv'] = true;
                $_SESSION["benutzer"] = $user_log;
                $_SESSION["benutzer_pk"] = $user_benutzerpk;
                // $_SESSION["mitteilung"] = 'Benutzername und Passwort OK!';

                // echo 'Benutzername und Passwort OK!';
                header('Location: dashboard.php');
                mysqli_close($link);
                die;
            } else {
                echo '<p style="color:red;"> Passwort falsch!</p>';
                mysqli_close($link);
                die;
            }

            // die;
        } elseif ($datensatz['benutzername'] == $max_benutzername) {
            echo ' <p style="color:red;">Benutzername nicht vergeben </p>';
            mysqli_close($link);
            die;
        }
    }
}


