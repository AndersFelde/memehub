<?php

$email = $_POST[ "email" ];
$passord = $_POST[ "passord" ];

$sql = "select email, bruker_id, passord 
        from bruker
        where email = '$email' and passord = '$passord'";

$resultat = $kobling->query( $sql );

if ( mysqli_num_rows( $resultat ) == 1 ) {

    $rad = $resultat->fetch_assoc();

    $bruker_id = $rad[ "bruker_id" ];

    $_SESSION[ "bruker_id" ] = $bruker_id;

    $prev_site = $_SESSION[ "prev_site" ];

    header( "Location: $prev_site" );
    
} else {
    
    $_SESSION["failed_login"] = "Feil brukernavn eller passord";
    
    header("Location: logg_inn.php");
    
}


?>