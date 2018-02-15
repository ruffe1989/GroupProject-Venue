<?php
//Check if admin:
session_start();
if (!isset($_SESSION['id']) || $_SESSION['id'] == "user") {
    header("Location: /utested/login.php");
}
?>
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
        <div id="wrapper-admin">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
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
                            <li><a href="/utested/admin/adminIndex.php">Dashboard</a></li>
                            <li><a href="/utested/">Hovedsiden</a></li>
                            <li><a href="/utested/logout.php"><button type="button" class="btn btn-success">Logg ut</button></a></li>
                        </ul>
                    </div>
                </div>    
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                            <li><a href="/utested/admin/createArr.php">Lag arrangement</a></li>
                            <li><a href="/utested/admin/editArr.php">Endre  arrangement</a></li>
                            <li><a href="/utested/admin/userList.php">Se liste over brukere</a></li>
                        </ul>
                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>        








