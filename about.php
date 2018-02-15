<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/phpHead.php";
include "$root/utested/phpinclude/rutine.php";
?>

<div class="container">
    <div class="arrhead center">
        <div id="map"></div>
    </div>
    <div class="page-header"><h1>Kontaktinfo</h1></div> 
    <div class="row">
        <div class="col-sm-3" id="arrDetails">
            <div class="sidebar-module sidebar-module-inset">
                <h3>Postadresse:</h3>
                <p>Eldøy Kulturpark<br />
                    Postboks 404<br />
                    5411 Stord</p>
                <h3>Besøksadresse: </h3>
                <p>Eldøy Kulturpark<br />
                    Krono 29<br />
                    5411 Stord</p>

            </div>
        </div>

        <div class="col-sm-8">
            <h4>Kontaktskjema:</h4>
            <div class="well">
                <?php if(!empty($statusMsg)){ ?>
                <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
                <?php } ?>
                <form method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name" class="h4">Fullt navn</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="F. eks Ola Normann" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email" class="h4">Epost</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="epost@eksempel.no" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="subject" class="h4">Emne</label>
                            <input type="text" id="subject" class="form-control" name="subject" placeholder="Hva lurer du på?" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="h4 ">Melding</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required> </textarea>
                    </div>
                    <input type="submit" name="submit" value="Send melding" class="btn btn-primary btn-lg pull-right">
                    <div class="clearfix"> </div>

                </form>
            </div> 
            <?php
            $statusMsg = '';
            $msgClass = '';

            if(isset($_POST['submit'])){
                // Info fra sender
                $email = mPostCleaner("email");
                $name =  mPostCleaner("name");
                $subject = mPostCleaner("subject");
                $message = mPostCleaner("message");
                // Kontroll av at alt er fylt inn
                if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                        echo "<script>";
                        echo "alert('Venligst fyll inn riktig epostformat: eksempel@eksempel.no')"; 
                        echo "</script>";
                    }else{
                        //Beskjeden som mottaker får
                        $toEmail = '151539@student.hit.no';
                        $emailSubject = 'Beskjed sendt fra kontaktskjema fra '.$name;
                        $htmlContent = '<h2>Kontaktinfo</h2>
                <h4>Navn</h4><p>'.$name.'</p>
                <h4>Epost</h4><p>'.$email.'</p>
                <h4>Emne</h4><p>'.$subject.'</p>
                <h4>Beskjed</h4><p>'.$message.'</p>';
                        // For å kunne sende epost via html må denne headeren følge med
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // Header som forklarer mottaker hvem eposten er sendt fra
                        $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
                        //Pga at man må sette opp en smtp server for at mail() skal funke har vi valgt denne løsningen når mail skal sendes.
                        if(!@mail($toEmail,$emailSubject,$htmlContent,$headers)){
                            echo "<script>";
                            echo "alert('Vi har noen tekniske problemer. Hvis det haster, ta kontakt på telefon.')"; 
                            echo "</script>";
                            $msgClass = 'succdiv';
                        } else {
                            echo "<script>";
                            echo "alert('Melding er sendt og vi tar kontakt med deg så snart som mulig')"; 
                            echo "</script>";
                        }
                    }
                }else{
                    echo "<script>";
                    echo "alert('Alle felt må fylles ut!')"; 
                    echo "</script>";
                }
            }

            ?>
        </div>
        <script>function initMap() {
                var krono = {lat: 59.7600318, lng: 5.4747155};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: krono
                });
                var marker = new google.maps.Marker({
                    position: krono,
                    map: map
                });
            }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLXkbL-_IJ7-wZf2Pzwz6vZR-OIMA1ey0&callback=initMap">
        </script>
    </div>
    <?php
    include "$root/utested/phpinclude/phpFooter.php";
    ?>