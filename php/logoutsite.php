<?php
session_start();
session_destroy();
unset($_SESSION);

include('headersub.php');
?>


<div id="divlogout">
	<p>Sie sind nun abgemeldet!</p> <a href="loginsite.php">Anmeldeseite aufrufen?</a>
</div>



<?php
include('footer.php');
?>