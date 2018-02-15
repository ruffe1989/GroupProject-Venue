<?php 

$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/adminHeader.php";
include "$root/utested/phpinclude/rutine.php";
?>
<?php


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Administrasjonsside for Eldøy Kulturpark</h1>
        <div class="table-responsive">
            <h3>Solgte billetter:</h3>
        <table class="table table-striped">
            <tr>
                <th>Event nr</th>
                <th>Navn</th>
                <th>Solgte billetter</th>
                <th>Opptjent</th>
            </tr>
        <?php
        include "$root/utested/phpinclude/connect.php";
        $resultat=mysqli_query($con,"CALL ticketSale;");
        while($rad=mysqli_fetch_array($resultat,MYSQLI_ASSOC)) {
            $EventID = $rad['EventID'];
            $Opptjent = $rad['Opptjent'];
            $Antall = $rad['Antall'];
            $Name = $rad['Name'];
          echo "<tr>";
            echo "<td>$EventID</td>";
            echo "<td>$Name</td>";
            echo "<td>$Antall</td>";
            echo "<td>$Opptjent</td>";
            
        }
        $con->close();
        ?>
            </table>
    </div>
</div>

<?php 
include "$root/utested/phpinclude/adminFooter.php";
?>