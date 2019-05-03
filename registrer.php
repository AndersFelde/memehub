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
    //include "elements/nav.php";

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

                $email = $_POST[ "email" ];

                $sql = "select email
                        from bruker
                        where email = '$email'";

                $resultat = $kobling->query( $sql );

                if ( mysqli_num_rows( $resultat ) == 0 ) {

                    if ( !empty( $_FILE[ "name" ] ) ) {

                        include "elements/lagre_bilde.php";

                    } else {

                        $bilde_name_new = "Placeholder-pfp.jpg";

                        $lagre_bilde = true;
                    }

                    if ( $lagre_bilde ) {

                        $sql = "insert into bruker (brukernavn, email, passord, bilde) VALUES('$brukernavn', '$email', '$passord', '$bilde_name_new')";

                        if ( $kobling->query( $sql ) ) {

                            $bilde_dest = 'images/user_images/' . $bilde_name_new;

                            move_uploaded_file( $bilde_tmp_name, $bilde_dest );

                            $_SESSION[ "bruker_id" ] = $bruker_id;

                            header( "Location: index.php" );

                        } else {
                            echo "Det har skjedd en feil med spørringen
                                $kobling->error";
                        }
                    }

                } else {

                    echo "email " . '"' . $email . '"' . " er allerede i bruk";

                }

            } else {
                echo "Brukernavnet " . '"' . $brukernavn . '"' . " er allerede i bruk";
            }
        } else {

            echo "Passordene du har oppgitt samsvarer ikke";
        }

        } elseif (isset($_POST["cancel"])) {
          header( "Location: logg_inn.php" );
        }


    ?>

        <a href="index.php" class="Material exit">clear</a>

          <div class="loginWidth">
            <a href="index.php"><img src="images/logo.png" alt="MemeHub"></a>
            <div class="loginError">
              Brukernavnet er optatt / email er i bruk
            </div>
            <div class="loginBox">

              <form action="registrer.php" method="post" enctype="multipart/form-data">
                  <label>Email</label>
                  <input type="email" required name="email">
                  <label>Brukernavn</label>
                  <input type="text" required name="brukernavn">
                  <label>Passord</label>
                  <input type="password" required name="passord">
                  <label>Gjenta Passord</label>
                  <input type="password" required name="passord_r">
                  <label>Bilde</label>
                  <input type="file" name="bilde">
                  <div class="buttonSplit">
                    <button type="submit" value="cancel" name="cancel">Tilbake</button>
                    <button type="submit" value="Registrer" name="registrer" class="orange">Registrer</button>
                  </div>
              </form>
            </div>
            <a href="#" class="forgotPassword">Spørsmål?</a>
          </div>
</body>
</html>
