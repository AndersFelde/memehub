<?php
        include "kobling.php";

        $sql = "SELECT kategori, COUNT(kategori) as count FROM kategori group by kategori";

        $resultat = $kobling->query( $sql );

        while ( $rad = $resultat->fetch_assoc() ) {

            $kategori = $rad[ "kategori" ];
            $count = $rad[ "count" ];


            echo "$kategori($count),";

        }
        $sql = "SELECT brukernavn, bilde FROM bruker order by brukernavn;";

        $resultat = $kobling->query( $sql );

        while ( $rad = $resultat->fetch_assoc() ) {

            $brukernavn = $rad[ "brukernavn" ];
            $bilde = $rad[ "bilde" ];

            echo "$brukernavn*images/user_images/$bilde,";

        }
?>