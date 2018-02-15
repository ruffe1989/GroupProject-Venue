<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/utested/phpinclude/connect.php";
include "$root/utested/phpinclude/adminHeader.php";


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Brukere</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Brukernavn</th>
                <th>Epost</th>
                <th>Administrator</th>
                <th>Endre brukerrettigheter</th>
            </tr>

            <?php
            $sql = 'SELECT * FROM user';
            $result = mysqli_query($con, $sql);

            echo "<form method='post'>";
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>";
                if ($row['IsAdmin']) {
                    echo "Ja";
                } else
                    echo "Nei";

                echo "</td>";
                echo '<td><input type="radio" name="editRadio" value="' . $row['UserID'] . '" /></td>';
                echo "</tr>";
            }

            echo "</table>";
            echo "<input type=\"submit\" name=\"execEditArr\" value=\"Utfør\" />";
            echo "</form>";

            $edit = "";

            if (isset($_POST['editRadio'])) {
                $edit = $_POST['editRadio']; 
            }      


            if (isset($_POST['execEditArr'])) {
                $checkAdmin = "
                    SELECT
                        Username,
                        IsAdmin
                    FROM
                        user
                    WHERE
                        UserID=$edit
                    AND
                        IsAdmin = 1
                    ";
                $result = mysqli_query($con, $checkAdmin);

                if (mysqli_num_rows($result) == 0){
                    mysqli_query($con,"UPDATE user
                                    SET isAdmin = '1'
                                    WHERE user.UserID = $edit");
                    header("Location: /utested/admin/userlist.php");
                }
                else {
                    mysqli_query($con,"UPDATE user
                                    SET isAdmin = '0'
                                    WHERE user.UserID = $edit");
                    header("Location: /utested/admin/userlist.php");
                }

            }
            
            ?>
            </div>
    </div>

    <?php
    include "$root/utested/phpinclude/adminFooter.php";
    ?>