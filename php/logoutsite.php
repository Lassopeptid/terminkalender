Sie sind nun abgemeldet!

<?php
session_start();
session_destroy();
unset($_SESSION);
	// setcookie("login_merken", "", time() -1); # cookie entfernen beim Client
	// unset($_COOKIE["login_merken"]);