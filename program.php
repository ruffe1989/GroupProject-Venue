<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/phpHead.php";
include "$root/utested/phpinclude/connect.php";
?>

<div class="container">

    <div class="arrhead center">
        <img src="/utested/img/17a.jpg" alt="Utsiktsbilde av Elderøy" class="arrImg">
    </div>

    <div class="page-header"><h1>Program</h1></div>
    <div class="row"> 
        <div class="col-sm-3" id="arrDetails">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Info:</h4>
                <p>Her er en oversikt over de fremtidige arrangementene som skal arrangeres ved
                    Eldøy Kulturpark. Mye forskjellig til alle musikk- og kulturinteresserte.<br /><br />Velkommen til Eldøy kulturpark!</p>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="table-responsiv">
                <table class="table table-striped">
                    <tr>
                        <th>Arrangement:</th>
                        <th>Dato:</th>
                        <th>Pris:</th>
                        <th>Alder:</th>
                        <th>Billetter:</th>
                    </tr>  
                    <?php    
                    $sql = "CALL activeArr";

                    $result = mysqli_query($con,$sql);
                    foreach ($result as $key => $value) {
                        $newDate = date("d-m-Y", strtotime($value['Date']));
                        $age = $value['Age'];
                        echo "<tr>";

                        echo "<td>" . 
                            '<a class="arrLink" href="/utested/Arrangement.php?eventid=' . $value['EventID'] . '">' . $value['Name'] . '</a>' . "</td>";
                        echo "<td>" . $newDate . "</td>";
                        echo "<td>" . $value['Fee'] . "</td>";
                        if ($age == 0)
                            $age = "Fri";
                        echo "<td>" . $age . " </td>";
                        echo '<td><button type="button" class="btn btn-primary" onclick="location.href=' . "'/utested/booking/bookSeat.php?event=" . $value['EventID'] . "'\">Kjøp her</button></td>";
                        echo "</tr>";
                    }
                    if (isset($_GET['event'])){
                        $_SESSION['event'] = $_GET['event'];
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>


    <?php 
    include "$root/utested/phpinclude/phpFooter.php";
    ?>