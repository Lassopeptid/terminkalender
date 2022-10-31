<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerminBuster</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="terminkalender.png" type="image/x-icon">
</head>

<body>
    <div id="container">
        <nav id="leftnav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="php/loginsite.php">Login</a>
                </li>
                <li><a href="php/dashboard.php"> <?php include('php/sessioncheck.php'); ?> </a>
                    <ul>
                        <li><a href="php/logoutsite.php">Abmelden</a></li>

                    </ul>
                </li>

            </ul>
        </nav>

        <header>
            <h1>TerminBuster - Mehr Termin geht nicht! -</h1>
        </header>

        <main>