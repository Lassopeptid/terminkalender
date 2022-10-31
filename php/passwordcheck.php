<?php
function passwordcheck($post_string)
{
    $pwd_ok = 0;
    $str = $post_string;
    // $str = 'Hj7s-3ui80d'; /////
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


    $array_unique = array_unique($pwd_check);


    $nmb = array(1, 2, 3, 4);

    if (!in_array(1, $array_unique)) {
        echo '<div id= "divfalsch"><p id="bnnameefalsch">Bitte einen Großbuchstaben verwenden.</p></div>';
    }
    if (!in_array(2, $array_unique)) {
        echo '<div id= "divfalsch"><p id="bnnameefalsch">Bitte einen Kleinbuchstaben verwenden.</p></div>';
    }
    if (!in_array(3, $array_unique)) {
        echo '<div id= "divfalsch"><p id="bnnameefalsch">Bitte eine Zahl verwenden.</p></div>';
    }
    if (!in_array(4, $array_unique)) {
        echo '<div id= "divfalsch"><p id="bnnameefalsch">Bitte ein Sonderzeichen verwenden.</p></div>';
    }
    if ($j < 8) {
        echo '<div id= "divfalsch"><p id="bnnameefalsch">Das Passwort muss mindestens 8 Zeichen lang sein. Aktuelle Länge: ' . $j . ' Zeichen.</p></div>';
    }
    if (array_values($nmb) === array_values($array_unique) && $j >= 8) {

        $hashed_pwd =  password_hash($str, PASSWORD_DEFAULT);
        // include('connect.php');
        // $befehl_pwd = "INSERT INTO anmeldung(benutzer_fk, passwort) VALUES ('$bname_pk', '$hashed_pwd')";
        // mysqli_query($link, $befehl_pwd);
        // mysqli_close($link);
        // header('Location: loginsite.php');
        // die;
        $pwd_ok = 1;

        // $_SESSION['pwd_ok'] = true;
    }
    return[ $pwd_ok, $hashed_pwd];
}
$pwd_ok = passwordcheck($post_string);
// print_r( $pwd_ok );
// echo $hashed_pwd;
// echo '<br>'. $pwd_ok[0].'<br>';
// echo $pwd_ok[1];