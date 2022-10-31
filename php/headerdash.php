<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerminBuster</title>
    <link rel="stylesheet" href="../css/styledash.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="terminkalender.png" type="image/x-icon">
</head>

<body>
    <header>
        <h1>TerminBuster - Mehr Termin geht nicht! -</h1>
    </header>
    <div id="container">
        <nav id="leftnav">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="loginsite.php">Login</a> </li>
                <li><a href="dashboard.php"> <?php include('sessioncheck.php'); ?> </a>
                <li><a href="logoutsite.php"> Abmelden </a></li>

            </ul>
        </nav>



        <main>