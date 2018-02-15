<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/adminHeader.php";
include "$root/utested/phpinclude/rutine.php";




if ($_GET['EventID'] == NULL){
    header("Location: /utested/admin/editArr.php");
}

if(isset($_POST['submit']))
{

    // oppdaterer variablene
    $event = $_GET['EventID'];
    // variables for input data

    $arrName = mPostCleaner("Name");
    $date = mPostCleaner("Date");
    $comment = mPostCleaner("Comment");
    $description = mPostCleaner("Description");
    $fee = mPostCleaner("Fee");
    $time = mPostCleaner("Time");
    $age = mPostCleaner("Age");
    $producer = mPostCleaner("Producer");




    // Sql spørring som oppdaterer EventID'en
    $sql_update = "UPDATE event SET 
Name='$arrName',
Date='$date',
Comment='$comment',
Description='$description',
Age='$age',
Time='$time',
Producer='$producer',
Fee=$fee
WHERE EventID=$event";
    if($con->query($sql_update)){
        move_uploaded_file($_FILES['Bilde']['tmp_name'], $root . "/utested/img/arrangementer/picture$event.jpg");
    }

}

if(isset($_GET['EventID']))
{
    // henter informasjon fra databasen og printer det.
    $event = $_GET['EventID'];
    $sql_update="SELECT * FROM event WHERE EventID=$event";
    $result=$con->query($sql_update);
    if (!$result) {
        die('Error!' . mysqli_error($con));
    }
    $row = $result->fetch_array(MYSQLI_ASSOC);
}   
?>

<!-- html start -->

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Oppdater arrangement</h1>
    <div class="table-responsive">
        <!--Bruker form for å kunne hente ut data fra tabellen-->
        <form action="" method='POST' enctype="multipart/form-data">
            <table class="table table-striped" id="oppdaterarrangementtabell">
                <tr>
                    <th>Arrangement</th>
                    <th>Arrangør</th>
                </tr>
                <tr>
                    <td><input type="text" name="Name" placeholder="Arr name" value="<?php echo $row['Name']; ?>" required /></td>
                    <td><input type="text" name="Producer" placeholder="Eldøy park" value="<?php echo $row['Producer']; ?>" required /></td>
                </tr>
                <tr>
                    <th>Dato</th>
                    <th>Tid</th>
                                    </tr>

                <tr>
                    <td><input type="text" name="Date" placeholder="Dato" value="<?php echo $row['Date']; ?>" required /></td>
                    <td><input type="text" name="Time" placeholder="Time" value="<?php echo $row['Time']; ?>" required /></td>
                                    </tr>

                <tr>
                    <th>Pris</th>
                    <th>Alder</th>
                </tr>
                <tr>
                    <td><input type="text" name="Fee" placeholder="Fee" pattern="[0-9]+" value="<?php echo $row['Fee']; ?>" required /></td>
                    <td><input type="text" name="Age" placeholder="Alder" pattern="[0-9]{1,2}" value="<?php echo $row['Age']; ?>" required /></td>
                </tr>

                <tr>
                    <th>Beskrivelse</th>
                    <th>Bilde</th>
                </tr>
                <tr>
                    <td><input type="text" name="Comment" placeholder="Info" value="<?php echo $row['Comment']; ?>" required /></td>
                    <td><input type="file" name="Bilde" id="Bilde"></td>
                </tr>


                <tr>
                    <th colspan="2">Lang beskrivelse</th>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="Description" cols="80" rows="20" placeholder="Info" required ><?php echo $row['Description']; ?></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" class="btn-danger" value="UPDATE"></td>
                </tr>





            </table>
        </form>


    </div>

    <a href="/utested/admin/editArr.php" class="btn btn-primary" role="button">Avslutt endring</a>
    <br>
    <div><span class="errorTxt"><?php echo mysqli_error($con); ?></span></div>
</div>
<?php
include "$root/utested/phpinclude/adminFooter.php";
?>
