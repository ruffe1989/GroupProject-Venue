<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
session_start();

if (isset($_POST['plass']) && isset($_POST['event'])) {
    $sete = $_POST['plass'];
    $event = $_POST['event'];
    $username = $_SESSION['user'];
    $sql = "SELECT UserID FROM user WHERE Username = \"$username\"";


    $result = mysqli_query($con,$sql);
    $rad = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $userid = $rad['UserID'];

    $sql = "INSERT INTO ticket (EventID, SeatID, UserID)
VALUES ($event, $sete, $userid);";

    if ($con->query($sql) === TRUE) {
        echo "0";
    }
    else if (mysqli_errno($con) == 1644) {
        echo mysqli_error($con);
    }
    else {
        echo mysqli_errno($con);
    }
    $con->close();
}
?>