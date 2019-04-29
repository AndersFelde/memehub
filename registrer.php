<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Registrer | MemeHub - Nye dank memes hver uke";
    include "elements/head.php";
    ?>
</head>

<body>

    <?php
    include "elements/nav.php";

    if ( isset( $_POST[ "registrer" ] ) ) {

        $passord = $_POST[ "passord" ];
        $passord_r = $_POST[ "passord_r" ];

        if ( $passord == $passord_r ) {

            $brukernavn = $_POST[ "brukernavn" ];

            $sql = "select brukernavn 
                    from bruker 
                    where brukernavn = '$brukernavn'";

            $resultat = $kobling->query( $sql );

            if ( mysqli_num_rows( $resultat ) == 0 ) {

                include "elements/lagre_bilde.php";

                if ( isset( $lagre_bilde ) ) {

                    $email = $_POST[ "email" ];

                    $sql = "insert into bruker (brukernavn, email, passord, bilde) VALUES('$brukernavn', '$email', '$passord', '$bilde_name_new')";

                    if ( $kobling->query( $sql ) ) {

                        move_uploaded_file( $bilde_tmp_name, $bilde_dest );

                        $_SESSION[ "bruker_id" ] = $bruker_id;

                        $prev_site = $_SESSION[ "prev_site" ];

                        header( "Location: $prev_site" );

                    } else {
                        echo "Det har skjedd en feil med spørringen<br>
                                $kobling->error";
                    }
                }

            } else {
                echo "Brukernavnet " . '"' . $brukernavn . '"' . " er allerede i bruk";
            }
        } else {

            echo "Passordene du har oppgitt samsvarer ikke";

        }

    }
    ?>

    <form action="registrer.php" class="" method="post" enctype="multipart/form-data">
        <label>Email</label><br>
        <input type="email" required name="email"><br>
        <label>Brukernavn</label><br>
        <input type="text" required name="brukernavn"><br>
        <label>Passord</label><br>
        <input type="password" required name="passord"><br>
        <label>Gjenta Passord</label><br>
        <input type="password" required name="passord_r"><br>
        <label>Bilde</label><br>
        <input type="file" required name="bilde"><br>
        <input type="submit" value="Registrer" name="registrer">
    </form>

</body>
</html>