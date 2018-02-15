<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/phpHead.php";
include "$root/utested/phpinclude/connect.php";
?>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="/utested/img/14a.jpg" alt="First slide" class="center">
            <div class="container">
                <div class="carousel-caption">
                    <h1><span class="carouselH1">Velkommen til Eldøy Kulturpark</span></h1>
                </div>
            </div>
        </div>
        <?php 

        // Sorterer basert på hvor nært i tid arrangementet dukker opp.
        $sql = "CALL topArr";

        // Hent radene med arrangementer.
        $result = mysqli_query($con,$sql);

        while (($rad=mysqli_fetch_array($result,MYSQLI_ASSOC))) {
            // Navn på arrangement.
            $name = $rad['Name'];
            $eventID = $rad['EventID'];
            $picture = "/utested/img/arrangementer/picture" . $eventID . ".jpg";


            echo <<<KARUSELL
            <div class="item">
        <img src="$picture" alt="carousel image" class="center">
        <div class="container">
        <div class="carousel-caption">
    <h1><span class="carouselH1">$name</span></h1>
        <p><a class="btn btn-lg btn-primary carouselBtn" href="/utested/booking/bookSeat.php?event=$eventID" role="button">Kjøp Billetter</a></p>'
        </div>
        </div>
        </div>
KARUSELL;

        }
        $con->close();
        ?>

    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<!-- Section inneholder alle gunstige arrangement -->
<div class="container">
    <div class="page-header"><h1>Kommende konserter</h1></div>

    <div class="row">
        <?php
        include "$root/utested/phpinclude/connect.php";
        $maksAntall = 0;       
        $result=mysqli_query($con,"CALL activeArr");

        // Gå igjennom hver rad.
        while (($rad=mysqli_fetch_array($result,MYSQLI_ASSOC)) && $maksAntall< 6) {
            // Info om arrangement.
            $maksAntall ++;
            $name = $rad['Name'];
            $eventID = $rad['EventID'];
            $picture = "/utested/img/arrangementer/picture" . $eventID . ".jpg";
            $dato = date("d-m-Y", strtotime($rad['Date']));
            $comment = $rad['Comment'];

            echo <<<ETARRANGEMENT
            <div class="col-lg-4" style="min-height: 350px;">
            <a class="arrLink" href="/utested/Arrangement.php?eventid=$eventID" >
                <h3 class="titleArr">$name</h3>
                <h4 class="dateArr">$dato</h4>
                <img class="img-thumbnail img-responsive" src="$picture" alt="Bilde fra arrangement">
                <p class="describeArr">$comment</p>
                </a>
                </div>


ETARRANGEMENT;

        }

        ?>
    </div>

</div>
<?php include "$root/utested/phpinclude/phpFooter.php"?>