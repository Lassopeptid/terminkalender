Dashboard
-- Alle Termine im Überblick! --

<!--  Test session -->
<a href="logoutsite.php">
    <button id='btnlogout' name='logout'>Abmelden</button>
</a>

<br>

<form action="dashboard.php" method=POST>
    <input type="submit" name="anzeige" value=' Anstehende Termine einsehen' id='display'>
</form>

<form action="dashboard.php" method=POST>
    <input type="submit" name="archiv" value=' Archiv einsehen' id='display'>
</form>

<form action="dashboard.php" method=POST>
    <input type="submit" name="termin_erstellen" value=' Termin erstellen' id='display'>
</form>


<?php
session_start();
// error_reporting(0);
$session_user =  $_SESSION["benutzer"];
$session_pk = $_SESSION["benutzer_pk"];
if (!isset($session_pk)) {
    echo 'keine aktive Session.';
}

include('connect.php');
$befehl_name = "SELECT nachname, vorname, email FROM person WHERE person_fk = '$session_pk'";
$antwort_name = mysqli_query($link, $befehl_name);
$data = mysqli_fetch_array($antwort_name);
$data_nname = $data['nachname'];
$data_vname = $data['vorname'];
$data_email = $data['email'];
// mysqli_close($link);

echo '<br>Willkommen ' . $data_vname . '!';

?>


<!-- <form action="" method=POST>
    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>

    <label for="uhrzeit">Uhrzeit:</label>
    <input type="time" id="uhrzeit" name="uhrzeit" value="<?php echo date("h:i"); ?>" required>

    <p><label for="temin">Terminbeschreibung:</label></p>
    <textarea id="termin" name="termin" rows="4" cols="50" placeholder="Termin hier eintragen...max 100 Zeichen" maxlength='100' required></textarea>
    <input type="submit" name="termin_submit" value=' Termin bestätigen'>
</form> -->



<?php

if (isset($_POST['termin_erstellen'])) {

    $val_input = date('Y-m-d');
    $val_inputzeit = date("h:i");


    echo '
    <h2>Erstellen Sie hier schnell und zuverlässig einen Termin!</h2>
<form action="" method=POST>
<label for="datum">Datum:</label>
<input type="date" id="datum" name="datum" min="' . $val_input . '" value="' . $val_input . '" required>

<label for="uhrzeit">Uhrzeit:</label>
<input type="time" id="uhrzeit" name="uhrzeit" value="' . $val_inputzeit . '" required>

<p><label for="temin">Terminbeschreibung:</label></p>
<textarea id="termin" name="termin" rows="4" cols="50" placeholder="Termin hier eintragen...max 100 Zeichen" maxlength="100" required></textarea>
<input type="submit" name="termin_submit" value=" Termin bestätigen">
</form>

';
}

if (isset($_POST['termin_submit_bearbeiten'])) {

    $datum = htmlspecialchars($_POST['datum']);
    $uhrzeit = htmlspecialchars($_POST['uhrzeit']);
    $termin = mysqli_real_escape_string($link, $_POST['termin']);

    $befehl_bearbeiten = "UPDATE eintraege SET termin='$termin', datum='$datum', uhrzeit='$uhrzeit'  WHERE termin_pk =" . $_GET["bearbeiten"];
    mysqli_query($link, $befehl_bearbeiten);

    echo '<p> Der Termin wurde erfolgreich bearbeitet!</p>';
    echo '<p>Am ' . $datum . ' um ' .  $uhrzeit . ' hast du folgenden Termin notiert: </p>';
    echo '<p>' . $termin . '</p>';
    // echo date('Y-m-d');

    echo '
<form action="" method=POST id="termin_submit_bearbeiten" style="display:none;">';


}


if (isset($_GET["bearbeiten"])) {

    $befehl_termin_bearbeiten = "SELECT termin, datum, uhrzeit FROM eintraege WHERE  termin_pk =" . $_GET["bearbeiten"];
    $antwort_termin_bearbeiten = mysqli_query($link, $befehl_termin_bearbeiten);
    $data_termin_bearbeiten = mysqli_fetch_array($antwort_termin_bearbeiten);
    $datatermin_bearbeiten = $data_termin_bearbeiten['termin'];
    $datadate_bearbeiten = $data_termin_bearbeiten['datum'];
    $datazeit_bearbeiten = substr($data_termin_bearbeiten['uhrzeit'], 0, 5);


    $val_input = date('Y-m-d');
    $val_inputzeit = date("h:i");


    echo '
    <h2>Bearbeiten Sie hier den ausgewählten Termin!</h2>
<form action="" method=POST id="termin_submit_bearbeiten">
<label for="datum">Datum:</label>
<input type="date" id="datum" name="datum" min="' . $val_input . '" value="' . $datadate_bearbeiten . '" required>

<label for="uhrzeit">Uhrzeit:</label>
<input type="time" id="uhrzeit" name="uhrzeit" value="' . $datazeit_bearbeiten . '" required>

<p><label for="temin">Terminbeschreibung:</label></p>
<textarea id="termin" name="termin" rows="4" cols="50"  required>' . $datatermin_bearbeiten . '</textarea>

<input type="submit" name="termin_submit_bearbeiten" value=" Änderung bestätigen">
</form>

';
}





if (isset($_GET["loeschen"])) {

    $befehl_termin_loechen = "SELECT termin, datum, uhrzeit FROM eintraege WHERE  termin_pk =" . $_GET["loeschen"];
    $antwort_termin_loechen = mysqli_query($link, $befehl_termin_loechen);
    $data_termin_loechen = mysqli_fetch_array($antwort_termin_loechen);
    $datatermin_loechen = $data_termin_loechen['termin'];
    $datadate_loechen = $data_termin_loechen['datum'];
    $datazeit_loechen = substr($data_termin_loechen['uhrzeit'], 0, 5);


    $befehl_loeschen = "DELETE FROM eintraege WHERE termin_pk =" . $_GET["loeschen"];
    mysqli_query($link, $befehl_loeschen);
    echo '<p>Der Termin am ' . $datadate_loechen . ' um ' .  $datazeit_loechen . ' wurde erfolgreich gelöscht! </p>';
    echo '<p>Inhalt der Terminbeschreibung: ' . $datatermin_loechen . '</p>';
    mysqli_close($link);
}

if (isset($_POST['termin_submit'])) {

    $datum = htmlspecialchars($_POST['datum']);
    $uhrzeit = htmlspecialchars($_POST['uhrzeit']);
    $termin = mysqli_real_escape_string($link, $_POST['termin']);

    echo '<p> Der Termin wurde erfolgreich gespeichert!</p>';
    echo '<p>Am ' . $datum . ' um ' .  $uhrzeit . ' hast du folgenden Termin notiert: </p>';
    echo '<p>' . $termin . '</p>';
    // echo date('Y-m-d');

    $befehl_termin = "INSERT INTO eintraege(termin_fk, termin, datum, uhrzeit) VALUES ('$session_pk','$termin','$datum','$uhrzeit')";
    $antwort_termin = mysqli_query($link, $befehl_termin);
    mysqli_close($link);
}







if (isset($_POST['anzeige'])) {

    $befehl_terminanzeige = "SELECT termin, datum, uhrzeit, termin_pk FROM eintraege WHERE termin_fk= '$session_pk' ORDER BY datum";
    $antwort_terminanzeige = mysqli_query($link, $befehl_terminanzeige);
    echo "
    <table>
        <tr>
            <td> Termin Bearbeiten</td>
            <td> Termin löschen </td>
            <td> Beschreibung </td>
            <td> Datum </td>
            <td> Uhrzeit </td>
        </tr>
    ";
    while ($data_terminanzeige = mysqli_fetch_array($antwort_terminanzeige)) {

        $datapk = $data_terminanzeige['termin_pk'];
        $datatermin = $data_terminanzeige['termin'];
        $datadate = $data_terminanzeige['datum'];
        $datazeit = substr($data_terminanzeige['uhrzeit'], 0, 5);

        if ($datadate >= date('Y-m-d')) {
            echo "
        <tr>
            <td><a href='?bearbeiten=" . $datapk . "'>Bearbeiten</a></td>
            <td><a href='?loeschen=" . $datapk . "'>Löschen</a></td>
            <td> " . $datatermin . " </td>
            <td> " . $datadate . " </td>
            <td> " . $datazeit . "  </td>
        </tr>
        ";
        }
    }
    echo " 
    </table>";
    mysqli_close($link);
}



if (isset($_POST['archiv'])) {

    $befehl_terminanzeige = "SELECT termin, datum, uhrzeit, termin_pk FROM eintraege WHERE termin_fk= '$session_pk' ORDER BY datum";
    $antwort_terminanzeige = mysqli_query($link, $befehl_terminanzeige);
    echo "
    <table id='eintraege_tab' > 
        <tr>
            <td> Termin löschen </td>
            <td> Beschreibung </td>
            <td> Datum </td>
            <td> Uhrzeit </td>
        </tr>
    ";
    $i = 0;
    while ($data_terminanzeige = mysqli_fetch_array($antwort_terminanzeige)) {

        $datapk = $data_terminanzeige['termin_pk'];
        $datatermin = $data_terminanzeige['termin'];
        $datadate = $data_terminanzeige['datum'];
        $datazeit = substr($data_terminanzeige['uhrzeit'], 0, 5);
        $array_archiv = [];
        if ($datadate < date('Y-m-d')) {
            // $i++;
            $array_archiv[] = 1;
            echo "
        <tr>
            <td><a href='?loeschen=" . $datapk . "'>Löschen</a></td>
            <td> " . $datatermin . " </td>
            <td> " . $datadate . " </td>
            <td> " . $datazeit . "  </td>
        </tr>
        ";
        }
    }

    echo " 
    </table>";

    if (  empty($array_archiv)  ) {
        echo '<p>Keine archivierten Termine.</p>';
        echo "
        <table id='eintraege_tab' style='display: none;'>";
        die;
    }

    mysqli_close($link);
}
