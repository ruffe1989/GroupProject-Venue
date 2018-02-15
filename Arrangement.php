<?php
if (!isset($_GET['eventid'])) {
    Header("Location: /utested/");
}
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/phpHead.php";

$eid = $_GET['eventid'];

$sql = "SELECT * FROM Event WHERE EventID = $eid";
$eventinfo = mysqli_fetch_array(mysqli_query($con,$sql),MYSQLI_ASSOC);
$eventID = $eventinfo['EventID'];
$arrName = $eventinfo['Name'];
$fee = $eventinfo['Fee'];
$date = date("d-m-Y", strtotime($eventinfo['Date']));
$time = date("H:i", strtotime($eventinfo['Time']));
$producer = $eventinfo['Producer'];
$age = $eventinfo['Age'];
$age = ($age == "0") ? "Fri" : "$age år";
$picName = "/utested/img/arrangementer/picture" . $eventID . ".jpg";
$comment = $eventinfo['Comment'];
$description = $eventinfo['Description'];
$con->close();
echo <<<INNHOLD
<div class="container">

    <div class="arrhead center">
    <img src="$picName" class="arrImg">
    </div>

    <div class="page-header"><h1>$arrName</h1></div>

    <div class="row">

        <div class="col-sm-3" id="arrDetails">
            <div class="sidebar-module sidebar-module-inset">
            <h4>Arrangement info:</h4>
            <table style="width:100%">
                <tr>
                    <td>Pris:</td>
                    <td>$fee,-</td>
                </tr>
                <tr>
                    <td>Dato:</td>
                    <td>$date</td>
                </tr>
                <tr>
                    <td>Tidspunkt:</td>
                    <td>$time</td>
                </tr>
                <tr>
                    <td>Arrangør:</td>
                    <td>$producer</td> 
                </tr>
                <tr>
                    <td>Aldersgrense:</td>
                    <td>$age</td>
                </tr>
                </table> <br>
                <a href="/utested/booking/bookSeat.php?event=$eventID"><button type="button" class="btn btn-success">Kjøp billett</button></a>
          </div>

        </div>

    <div class="col-sm-8">
           <div class="arrInfo">
               <h2>$comment</h2>
               <p>$description</p>
               </div>
        </div>

    </div>

</div>
INNHOLD;
include "$root/utested/phpinclude/phpFooter.php";
?>