<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/adminHeader.php";
include "$root/utested/phpinclude/connect.php";



if (! isset($_POST['Submit'])) {
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Lag nytt arrangement</h1>

    <div class="col-xs-6 col-sm-3 placeholder">
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Arrangement: </label><br>
                            <input type="text" name="Name" placeholder="Skriv navn her" id="Name" required><br>
                        </div>
                        <div class="form-group">
                            <label for="Dato">Dato:</label><br>            
                            <input type="date" name="Dato" value="" id="Dato" size="10" placeholder="1900.01.01" required><br><!-- Valideringa skriker av denne placeholderen, men den er et nødvendig onde..-->
                        </div>
                        <div class="form-group">
                            <label for="Time">Dørene åpner:</label><br>
                            <input type="time" name="Time" value="" id="Time" size="8" placeholder="20:00" required><br>
                        </div>
                        <div class="form-group">
                            <label for="Fee">Billettpris: </label><br>
                            <input type="text" name="Fee" placeholder="199.99" id="Fee" size=5 required><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Age">Aldersgrense: </label><br>
                            <input type="text" name="Age" placeholder="18" id="Age" size=3 required><br>
                        </div>
                        <div class="form-group">
                            <label for="Producer">Arrangør: </label><br>
                            <input type="text" name="Producer" placeholder="Eldøy Kulturpark" id="Producer" size=16 required ><br>
                        </div>
                        <div class="form-group">
                            <!-- VIKTIG "file_uploads = On" må være på for at dette skal gå -->
                            <label for="fileToUpload">Last opp headerbilde:</label><br><input type="file" name="fileToUpload" id="fileToUpload" required><br>  
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="Comment">Beskrivelse: </label><br>
                            <textarea class="form-control" rows="1" cols="50" id="Comment" name="Comment"></textarea><br>
                            <label for="Comment">Om forestillingen: </label><br>
                            <textarea class="form-control" rows="8" cols="50" id="LongDescription" name="LongDescription"></textarea><br>

                            <input type="submit" value="Submit" name="Submit" id="Submit" class="btn submit">
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>
<?php
}
else { 
    $arrName = mysqli_real_escape_string($con, $_REQUEST['Name']);
    $date = mysqli_real_escape_string($con, $_REQUEST['Dato']);
    $time = mysqli_real_escape_string($con, $_REQUEST['Time']);
    $comment = mysqli_real_escape_string($con, $_REQUEST['Comment']);
    $description = mysqli_real_escape_string($con, $_REQUEST['LongDescription']);
    $fee = mysqli_real_escape_string($con, $_REQUEST['Fee']);
    $producer = mysqli_real_escape_string($con, $_REQUEST['Producer']);
    $age = mysqli_real_escape_string($con, $_REQUEST['Age']);
    $eventID = 0;
    $active = 1;
    if ($date >= date("Y-m-d H:i:s")) {
        $active = 1;
    } else $active = 0;

    $sql = "INSERT INTO event (Name, Date, Time, Comment, Description, Producer, Age, Fee, Active) VALUES ('$arrName', '$date', '$time', '$comment', '$description', '$producer', '$age', '$fee', '$active')";
 
    if(mysqli_query($con, $sql)){
        // Lagre bilde på disk.
        $eventID = mysqli_insert_id($con);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $root . "/utested/img/arrangementer/picture$eventID.jpg");

        // Åpne arrangementsiden.
        header("Location: /utested/Arrangement.php?eventid=$eventID");
    } 
    else {
        echo '<div style="padding-top: 50px; text-align: center;">';
        echo '<ul class="list-unstyled">';
        echo '<li><span class="errorTxt">' . mysqli_error($con) . '</span></li>';
        echo '<li><a href="/utested/admin/createArr.php" class="btn btn-danger" role="button">Prøv på nytt?</a></li></ul></div>';
    }
}
include "$root/utested/phpinclude/adminFooter.php";
?>
