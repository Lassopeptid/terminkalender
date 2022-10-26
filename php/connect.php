<?php
include_once('dbdata.php');
$link = mysqli_connect(domain, user, pwd, db);
// mysqli_query($link, "SET names utf8"); # Verbindung auf utf-8 umstellen