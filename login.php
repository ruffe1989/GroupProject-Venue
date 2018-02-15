<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/rutine.php";
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
        <link rel="stylesheet" type="text/css" href="/utested/css/signin.css">
    </head>

    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/utested/phpinclude/connect.php';
        ?>
        <div class="container">
            <form class="form-signin" method=post>
                <h2 class="form-signin-heading">LOGG INN</h2>

                <label for="inputEmail" class="sr-only">Brukernavn</label>

                <input type="text" id="inputEmail" class="form-control" name="name" placeholder="Brukernavn" required autofocus>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="create_user">Logg inn</button>
                <a href="/utested/admin/createUser.php">Lag ny bruker her</a><br> 
                <a href="/utested/index.php">Avbryt innlogging her!</a>
            </form>

        </div> <!-- /container -->

        <?php
        if(!isset($_POST['name'])){
            $errors[] = 'Feltet for brukernavn kan ikke være tomt';
        }
        if(!isset($_POST['password'])){
            $errors[] = 'Feltet for passord kan ikke være tomt';
        }
        else {
            $username = mPostCleaner("name");
            $password = mPostCleaner("password");

            $username = stripslashes($username);
            $password = stripslashes($password);

            //Her hadde det vært greit med en lagret rutine, men siden sql setningen bruker variabler er det ikke mulig
            $sql = "SELECT
                    UserID,
                    Username, 
                    Password
                FROM
                    user
                WHERE
                    Username='$username'
                AND
                    Password='$password'";

            $checkifadmin = "
                    SELECT
                        Username,
                        IsAdmin
                    FROM
                        user
                    WHERE
                        Username='$username'
                    AND
                        IsAdmin = 1
                    ";

            $result = mysqli_query($con, $sql);
            $admin = mysqli_query($con, $checkifadmin);
            $row = mysqli_fetch_array($result);
            $id = $row['UserID'];
            $db_password = $row['Password'];

            if($password != $db_password){
                echo "<script>";
                echo "alert('Passordet er ikke riktig, vennligst prøv på nytt')";
                echo "</script>";
            }
            else {            
                if(mysqli_num_rows($result) == 0)
                    echo 'You have to log in!';
                else if (mysqli_num_rows($admin) == 0) {
                    session_start();
                    $_SESSION['id']="user";
                    $_SESSION['user']=$username;
                    if (isset($_SESSION['event'])) {   
                        header("Location: /utested/booking/bookSeat.php?event=" . $_SESSION['event']);
                    }
                    else {
                        header("Location: /utested/index.php");
                    }
                    /*setcookie("id", "0", time()+3600, '/');
                    setcookie("username", $username, time()+3600, '/');*/
                } else {
                    session_start();
                    $_SESSION['id']="admin";
                    $_SESSION['user']=$username;
                    if (isset($_SESSION['event'])) {   
                        header("Location: /utested/booking/bookSeat.php?event=" . $_SESSION['event']);
                    }
                    else {
                        header('Location: /utested/admin/adminIndex.php');
                    }
                    /*setcookie("id", "1", time()+3600, '/');
                    setcookie("username", $username, time()+3600, '/');*/
                }
            } 
        }
        ?>      
    </body>
</html>
