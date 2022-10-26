<?php
// const domain = 'localhost';
// const user = 'root';
// const pwd = '';
// const db = 'terminkalender';
include_once('dbdata.php');
$link = mysqli_connect(domain, user, pwd, db);
// mysqli_query($link, "SET names utf8"); # Verbindung auf utf-8 umstellen

// $link = mysqli_connect("localhost", "root", "", "terminkalender"); //über php einbinden