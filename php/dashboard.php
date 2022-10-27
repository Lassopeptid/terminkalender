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
<br>
Erstellen Sie hier schnell und zuverlässig einen Termin!
<br>
<form action="" method=POST>
    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>

    <label for="uhrzeit">Uhrzeit:</label>
    <input type="time" id="uhrzeit" name="uhrzeit" value="<?php echo date("h:i"); ?>" required>

    <p><label for="temin">Terminbeschreibung:</label></p>
    <textarea id="termin" name="termin" rows="4" cols="50" placeholder="Termin hier eintragen...max 100 Zeichen" maxlength='100' required></textarea>
    <input type="submit" name="termin_submit" value=' Termin bestätigen'>
</form>



<?php

//Löschen
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
    // die;
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

    /*
    //Auflistung aller Einträge.
    $befehl_terminanzeige = "SELECT termin, datum, uhrzeit FROM eintraege ORDER BY datum";
    $antwort_terminanzeige = mysqli_query($link, $befehl_terminanzeige);
    echo "
        <table>
            <tr>
                <td> Löschen </td>
                <td> termin </td>
                <td> datum </td>
                <td> uhrzeit </td>
            </tr>
        ";
    // $i = 0;
    //Anzeige zukünftiger Termine.
    while ($data_terminanzeige = mysqli_fetch_array($antwort_terminanzeige)) {
        // $i++;
        // $datafk = $data_terminanzeige['termin_fk'];
        $datatermin = $data_terminanzeige['termin'];
        $datadate = $data_terminanzeige['datum'];
        // $datazeit = $data_terminanzeige['uhrzeit'];
        $datazeit = substr($data_terminanzeige['uhrzeit'], 0, 5);

        if ($datadate >= date('Y-m-d')) {
            echo "
            <tr>
                <td><a href='?loeschen=" . $datatermin . "'>Löschen</a></td>
                <td> " . $datatermin . " </td>
                <td> " . $datadate . " </td>
                <td> " . $datazeit . "  </td>
            </tr>
            ";
        }
    }
    echo " 
        </table>";
    */
    mysqli_close($link);
}




if (isset($_POST['anzeige'])) {


    //Auflistung aller Einträge.
    $befehl_terminanzeige = "SELECT termin, datum, uhrzeit, termin_pk FROM eintraege WHERE termin_fk= '$session_pk' ORDER BY datum";
    $antwort_terminanzeige = mysqli_query($link, $befehl_terminanzeige);
    echo "
    <table>
        <tr>
            <td> Löschen </td>
            <td> termin </td>
            <td> datum </td>
            <td> uhrzeit </td>
        </tr>
    ";
    // $i = 0;
    //Anzeige zukünftiger Termine.
    while ($data_terminanzeige = mysqli_fetch_array($antwort_terminanzeige)) {
        // $i++;
        $datapk = $data_terminanzeige['termin_pk'];
        $datatermin = $data_terminanzeige['termin'];
        $datadate = $data_terminanzeige['datum'];
        // $datazeit = $data_terminanzeige['uhrzeit'];
        $datazeit = substr($data_terminanzeige['uhrzeit'], 0, 5);

        if ($datadate >= date('Y-m-d')) {
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
    mysqli_close($link);
}



if (isset($_POST['archiv'])) {

    $befehl_terminanzeige = "SELECT termin, datum, uhrzeit, termin_pk FROM eintraege WHERE termin_fk= '$session_pk' ORDER BY datum";
    $antwort_terminanzeige = mysqli_query($link, $befehl_terminanzeige);
    echo "
    <table id= eintraege_tab > 
        <tr>
            <td> Löschen </td>
            <td> termin </td>
            <td> datum </td>
            <td> uhrzeit </td>
        </tr>
    ";
    $i = 0;
    //Anzeige archivierter Termine.
    while ($data_terminanzeige = mysqli_fetch_array($antwort_terminanzeige)) {

        $datapk = $data_terminanzeige['termin_pk'];
        $datatermin = $data_terminanzeige['termin'];
        $datadate = $data_terminanzeige['datum'];
        $datazeit = substr($data_terminanzeige['uhrzeit'], 0, 5);

        if ($datadate < date('Y-m-d')) {
            $i++;
            echo "
        <tr>
            <td><a href='?loeschen=" . $datapk . "'>Löschen</a></td>
            <td> " . $datatermin . " </td>
            <td> " . $datadate . " </td>
            <td> " . $datazeit . "  </td>
        </tr>
        ";
        }

        if ($i == 0) {
            echo 'Keine archivierten Termine.';
            die;
        }
    }
    echo " 
    </table>";
    mysqli_close($link);
}

