<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";

if (isset($_POST['event'])) {

    $eventid = $_POST['event'];

    echo mysqli_fetch_array(mysqli_query($con,"SELECT Fee FROM event WHERE EventID = $eventid"),MYSQLI_ASSOC)['Fee'] . " ";



    $sql = "SELECT ticket.SeatID
FROM ticket, event
WHERE event.EventID = ticket.EventID
AND event.EventID = $eventid";

    $returting = "";
    $result = mysqli_query($con, $sql);

    while ($rad=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $sete = $rad['SeatID'];
        $returting .= strval($sete) . " ";
    }

    echo $returting;
}
$con->close();
?>



