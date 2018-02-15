<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/phpHead.php";

if(!isset($_GET['event'])) {
    header("Location: /utested/program.php");
}
$event = $_GET['event'];

if(!isset($_SESSION['id'])) {
    $_SESSION['event']=$event;
    header("Location: /utested/login.php");
}
else {
    unset($_SESSION['event']);
}



$sql = "SELECT COUNT(SeatID) AS seteantall FROM seat;";
$result = mysqli_query($con,$sql);


// Antall seter
$antall = mysqli_fetch_array($result,MYSQLI_ASSOC)['seteantall'];

$eventnavn = mysqli_fetch_array(mysqli_query($con,"SELECT Name FROM event WHERE EventID = $event;"))['Name'];

$con->close();
echo "<div class='container'>";
echo "<div class='arrhead'>";
echo "<img src='/utested/img/27a.jpg' alt='Utsiktsbilde av Elderøy' class='img-thumbnail-program'>
    </div>";
echo "<div class='page-header'><h1>Billettbestiling til $eventnavn</h1></div>";
echo "<div class='row'>";
echo "<div class='col-lg-3' id='arrDetails'>";
echo "<div class='sidebar-module sidebar-module-inset'>";
echo "<p>Billettbestilling for <span id='eventnavn'>$eventnavn</span></p>";
echo "<p>Pris: <span id='pris'>0</span> kroner</p>";
echo "<p>Antall biletter: <span id='antallBilletter'>0</span></p>";
echo "<button class='btn btn-success' onclick='bestill()'>kjøp</button>";
echo "</div>";
echo "</div>";
echo "<div class='col-lg-6'>";
echo "<div id='seteWrapper'>";
for ($i = 1; $i <= $antall; $i++) {
    echo 
        <<<SETEDIV
            <div class="seter">
                <img id="s$i" src="/utested/img/ledigsete.png" onclick="reserver(this.id)">
            </div>
SETEDIV;
}
echo "<p><span id='testdata'></span></p>";
echo "</div>";
echo "</div>";
echo "</div>";

include "$root/utested/phpinclude/phpFooter.php";
?>


<script>



    var seter = new Array(<?php echo $antall + 1 ?>);
    var fee;

    var s = {
        LEDIG: 0,
        HOLDAV: 1,
        OPPTATT: 2,
    };


    function totalPris() {
        var antallBilletter = 0;
        for (var i = 1; i < seter.length; i++) if (seter[i] == s.HOLDAV) {
            antallBilletter++;
        }
        document.getElementById('antallBilletter').innerHTML = antallBilletter;
        document.getElementById('pris').innerHTML = antallBilletter*fee;
    };

    // Viser ledige og opptatte seter.
    function visOpptatte(eventnummer) {


        var opptattSeter = "";

        // Deler setene i rader. Math.sqrt(seter.length) kan byttes med et tall for ønsket antall seter per rad.
        seteBredde = document.getElementById('s1').clientWidth;

        document.getElementById('seteWrapper').style.width = seteBredde*Math.sqrt(seter.length) + "px";

        // Bruker xhr med POST for å finne ledige seter.
        var xhrLedig;
        xhrLedig = new xhRequest();
        xhrLedig.open("POST", "/utested/booking/getFilledSeats.php", true);
        xhrLedig.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrLedig.setRequestHeader("Connection", "close");


        xhrLedig.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                opptattSeter = this.responseText.split(" ").map(Number);
                fee = opptattSeter[0];

                for (var i = 1; i < seter.length; i++) {
                    seter[i] = s.LEDIG;
                }
                for (var j = 1; j < opptattSeter.length; j++) {
                    seter[opptattSeter[j]] = s.OPPTATT;
                }
                for (var i = 1; i < seter.length; i++) {
                    var sete = "s" + i;
                    if (seter[i] == s.OPPTATT) {
                        document.getElementById(sete).src = "/utested/img/opptattsete.png";
                    }
                    else {
                        document.getElementById(sete).src = "/utested/img/ledigsete.png";
                    }
                }
            }
        }

        xhrLedig.send("event=" + eventnummer);
    }

    visOpptatte(<?php echo $event; ?>);

    function reserver (plass) {

        var i = parseInt(plass.substr(1));

        if (seter[i] === s.LEDIG) {
            var tekst = "";

            var xhr;
            var params = "plass=" + i + "&event=" + <?php echo $event; ?>;
            xhr = new xhRequest();
            xhr.open("POST", "/utested/booking/hold.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Connection", "close");

            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "0") {
                        document.getElementById(plass).src = "/utested/img/valgtsete.png";
                        seter[i] = s.HOLDAV;
                    }
                    else if (this.responseText == "1062") {
                        document.getElementById(plass).src = "/utested/img/opptattsete.png";
                        seter[i] = s.OPPTATT;
                    }
                    else alert(this.responseText);
                    totalPris();
                }
            }
            xhr.send(params);


        }
        else if (seter[i] === s.HOLDAV) {
            var xhr;
            var params = "plass=" + i + "&event=" + <?php echo $event; ?>;
            xhr = new xhRequest();
            xhr.open("POST", "/utested/booking/unhold.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Connection", "close");

            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "0") seter[i] = s.LEDIG;
                    document.getElementById(plass).src = "/utested/img/ledigsete.png";
                    totalPris();
                }
            }
            xhr.send(params);
        }
    }

    function xhRequest() {
        var xhr;
        try { xhr = new XMLHttpRequest();} catch (e1) {
            try { xhr = new ActiveXObject("Msxml2.XMLHTTP");} catch (e2) {
                try {xhr = new ActiveXObject("Microsoft.XMLHTTP");} catch (e3) {
                    xhr = false;
                }
            }
        }
        return xhr;
    }

    function bestill() {
        var seterBestilt = "";
        for (var i = 1; i < seter.length; i++) {
            if (seter[i] == s.HOLDAV) {
                seter[i] = s.OPPTATT;
                document.getElementById("s"+i).src="/utested/img/opptattsete.png";
                seterBestilt += ", s" + i;
            }
        }
        if (seterBestilt.length > 0) alert("Du har nå kjøpt sete(ne) " + seterBestilt.substr(2) + 
                                           " for " + document.getElementById('pris').innerHTML + " kroner. Kvittering sendt til din epost." );
    }



</script>
