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
        $root=$_SERVER['DOCUMENT_ROOT'];
        include "$root/utested/phpinclude/connect.php";
        include "$root/utested/phpinclude/rutine.php";
        ?>
        <div class="container">

            <form class="form-signin" method=post action="">
                <h2 class="form-signin-heading">Bruker registrering</h2>
                <label for="inputUsername" class="sr-only">Brukernavn</label>
                <input type="text" id="inputEmail" class="form-control" name="name" placeholder="Brukernavn" required autofocus>
                <label for="inputEmail" class="sr-only">Epost address</label>
                <input type="email" id="inputEmail" class="form-control" name="mail" placeholder="Epost address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Passord" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="create_user">Opprett bruker</button>
                <a href="/utested/index.php">Avbryt registrering her!</a>
            </form>

        </div> <!-- /container -->

        <?php
        $error = false;
        if (isset($_POST['create_user'])){
            $user_name = mPostCleaner("name");
            $email = mPostCleaner("mail");
            $pass = mPostCleaner("password");


            if (strlen($user_name) < 3){
                $error = true;
                echo "<script>";
                echo "alert('Brukernavnet må inneholde minst 3 bokstaver.')"; 
                echo "</script>";
            }
            else if (strlen($user_name) > 25){
                $error = true;
                echo "<script>";
                echo "alert('Brukernavnet kan ikke være lengre enn 25 bokstaver')"; 
                echo "</script>";
            }
            else {
                $sql = "SELECT Username FROM user WHERE Username='$user_name'";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                if ($count != 0){
                    $error = true;
                    echo "<script>";
                    echo "alert('Brukernavn $user_name er allerede i bruk.')"; 
                    echo "</script>";
                }
            }

            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $error = true;
                echo "<script>";
                echo "alert('Det mangler .no eller lignende i slutten av eposten!')"; 
                echo "</script>";
            }
            else {
                $sql = "SELECT Email FROM user WHERE Email='$email'";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                if ($count != 0){
                    $error = true;
                    echo "<script>";
                    echo "alert('Epostadressen $email er allerede i bruk.')"; 
                    echo "</script>";
                }
            }
            if (strlen($pass) < 6){
                $error = true;
                echo "<script>";
                echo "alert('Passordet må innholde minst 6 tegn')"; 
                echo "</script>";
            }

            if (!$error){
                $sql = "INSERT INTO user (Username, Password, Email, IsAdmin)
                VALUES ('$user_name', '$pass', '$email', 0)";
                $res = mysqli_query($con, $sql);

                if ($res){
                    echo "<script>";
                    echo "alert('Ny bruker er registrert!'); location.href='/utested/login.php'";
                    echo "</script>";
                }
                else {
                    echo "<script>";
                    echo "alert('Her gikk noe galt, vennligst prøv senere'); location.href='/utested/index.php'";
                    echo "</script>";
                }
            }

        }

        ?>
    </body>
</html>