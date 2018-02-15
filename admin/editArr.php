<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/adminHeader.php";
include "$root/utested/phpinclude/rutine.php";


if (isset($_POST['deleteRadio'])) {
    $slett = mPostCleaner("deleteRadio");
    

    //--Delete arr
    $delete = "UPDATE event
           SET Active=0
           WHERE EventID = '$slett'";

    mysqli_query($con, $delete);
}

?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Endre arrangement</h1>
    <div class="table-responsive">
        <!--Bruker form for å kunne hente ut data fra tabellen-->
        <form action="" method='POST' onsubmit="return confirmDeletingEvent()" name="endreForm">
            <table class="table table-striped">
                <tr>
                    <th>Arrangement</th>
                    <th>Dato</th>
                    <th>Tid</th>
                    <th>Beskrivelse</th>
                    <th>Pris</th>
                    <th>Alder</th>
                    <th>Arrangør</th>
                    <th>Slett?</th>
                    <th>Endre</th>
                </tr>
                <?php
                $sql = "CALL activeArr";



                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['Name'];
                    $date = $row['Date'];
                    $time = $row['Time'];
                    $comment = $row['Comment'];
                    $fee =  $row['Fee'];
                    $age =  $row['Age'];
                        if ($age == 0) {
                            $age = "Fri";
                        }
                    $prod = $row['Producer'];
                    $eventid = $row['EventID'];
                    echo <<<FORMRAD
    <tr>
        <td>$name</td>
        <td>$date</td>
        <td>$time</td>
        <td>$comment</td>
        <td>$fee</td>
        <td>$age</td>
        <td>$prod</td>
        <td>
            <input type="radio" name="deleteRadio" value="$eventid">
        </td>
        <td>
            <a href="/utested/admin/update.php?EventID=$eventid"><button type="button" class="btn btn-success">Endre</button></a>
        </td>
    </tr>
FORMRAD;
                }
                ?>
<tr><td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="execDeleteArr" value="Slett" class="btn btn-danger" /></td>
        <td></td></tr>
            
            </table>
        </form>

        <script>
            function confirmDeletingEvent() {
                var returBoolean = false;
                document.endreForm.deleteRadio.forEach(
                    function (item) {
                        if (item.checked) returBoolean = confirm('Er du sikker på at du vil slette arrangementet?');
                    }
                );
                return returBoolean;
            }
        </script>
    </div>
</div>
<?php include "$root/utested/phpinclude/adminFooter.php"; ?>