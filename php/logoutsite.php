Sie sind nun abgemeldet!

<a href="loginsite.php">Anmeldeseite aufrufen</a>

<?php
session_start();
session_destroy();
unset($_SESSION);
	// setcookie("login_merken", "", time() -1); # cookie entfernen beim Client
	// unset($_COOKIE["login_merken"]);
