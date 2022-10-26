<?php

function passwordcheck($post_string, $bname_pk)
{

    $str = $post_string;

    $array_ascii = [];
    $j = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $array_ascii[] = $str[$i];
    }
    $pwd_check = [];
    $j = 0;
    foreach ($array_ascii  as $i) {
        $j++;
        if ($i > chr(64) && $i < chr(91)) {
            $pwd_check[] = 1;
        } elseif ($i > chr(96) && $i < chr(123)) {
            $pwd_check[] = 2;
        } elseif ($i > chr(47) && $i < chr(58)) {
            $pwd_check[] = 3;
        } else {
            $pwd_check[] = 4;
        }
    }

    // echo "<pre>";
    // print_r($post_string);
    // echo "</pre>";

    $array_unique = array_unique($pwd_check);


    $nmb = array(1, 2, 3, 4);

    if (!in_array(1, $array_unique)) {
        echo '<p style="color:red;">Bitte einen Großbuchstaben verwenden.</p>';
    }
    if (!in_array(2, $array_unique)) {
        echo '<p style="color:red;">Bitte einen Kleinbuchstaben verwenden.</p>';
    }
    if (!in_array(3, $array_unique)) {
        echo '<p style="color:red;">Bitte eine Zahl verwenden.</p>';
    }
    if (!in_array(4, $array_unique)) {
        echo '<p style="color:red;">Bitte ein Sonderzeichen verwenden.</p>';
    }
    if ($j < 8) {
        echo '<p style="color:red;">Das Passwort muss mindestens 8 Zeichen lang sein. Aktuelle Länge: ' . $j . ' Zeichen.</p>';

    }
    if (array_values($nmb) === array_values($array_unique) && $j >= 8) {

        $hashed_pwd =  password_hash($str, PASSWORD_DEFAULT);
        include('connect.php');
        $befehl_pwd = "INSERT INTO anmeldung(benutzer_fk, passwort) VALUES ('$bname_pk', '$hashed_pwd')";
        mysqli_query($link, $befehl_pwd);
        mysqli_close($link);
        header('Location: loginsite.php');
        die;
    }
}


// Hj7s-3ui80d