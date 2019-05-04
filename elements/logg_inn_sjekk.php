<?php

$email = $_POST[ "email" ];
$passord = $_POST[ "passord" ];

$sql = "select email, bruker_id, passord
        from bruker
        where email = '$email' and passord = '$passord'";

$resultat = $kobling->query( $sql );

if ( mysqli_num_rows( $resultat ) == 1 ) {
  $rad = $resultat->fetch_assoc();

  $_SESSION[ "bruker_id" ] = $rad[ "bruker_id" ];

  //header("Location: index.php");
  //exit;

} else {

  $loginFail = true;
}


?>
