Dashboard 
-- Alle Termine im Überblick! --

<!--  Test session -->
<a href="logoutsite.php" >
    <button id='btnlogout' name='logout'>Abmelden</button>
</a>

<?php
session_start();
// error_reporting(0);
$session_user =  $_SESSION["benutzer"];
$session_pk = $_SESSION["benutzer_pk"];
if ( !isset($session_pk)   ) {
 echo 'keine aktive Session.';
}



include('connect.php');
$befehl_name = "SELECT nachname, vorname, email FROM person WHERE person_fk = '$session_pk'";
$antwort_name = mysqli_query($link, $befehl_name);
$data = mysqli_fetch_array($antwort_name);
$data_nname = $data['nachname'];
$data_vname = $data['vorname'];
$data_email = $data['email'];
mysqli_close($link);

echo '<br>Willkommen ' . $data_vname . '!';