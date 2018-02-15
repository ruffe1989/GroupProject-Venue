<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Eldøy Kulturpark</title>
        <meta name="description" content="Eldhøy Kulturpark">
        <meta name="keywords" content="konsert, fyll, spetakkel">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="/utested/css/bootstrap.css">
        <link href="/utested/css/carousel.css" rel="stylesheet">

    </head>
    <body>
        <div id="wrapper">
            <div class="navbar-wrapper">
                <div class="container">

                    <nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="/utested/index.php"><img alt="Eldøy Kulturpark" src="/utested/img/logo.png" class="img-logo"></a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="/utested/index.php">Hovedside</a></li>
                                    <li><a href="/utested/program.php">Program</a></li>
                                    <li><a href="/utested/about.php">Kontakt</a></li>
                                    <?php
                                    if(isset($_SESSION['id'])){
                                        if($_SESSION['id'] == "admin") {
                                            echo '<li><a href="/utested/admin/adminIndex.php">Adminside</a></li>';
                                        }
                                        echo '<li><a><p style="color:#00FF00;">Logget inn som: ' . $_SESSION['user'] . '</p></a></li>';
                                    }

                                    if(!isset($_SESSION['id'])) {
                                        echo '<li><a href="/utested/login.php"><button type="button" class="btn btn-success">Logg inn</button></a></li>';
                                    }
                                    else {
                                        echo '<li><a href="/utested/logout.php"><button type="button" class="btn btn-success">Logg ut</button></a></li>';
                                    }
                                    ?>
                                </ul> <!-- Navbar UL -->
                            </div> <!-- Navbar -->
                        </div> <!-- Container -->
                    </nav> <!-- Navbar inverse -->
                </div> <!-- Container -->
            </div> <!-- Navbar-wrapper -->
        </div> <!-- Wrapper -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
