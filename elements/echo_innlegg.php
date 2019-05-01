<?php


function echo_innlegg( $ting ) {

    global $kobling;

    $sql = "select 
        innlegg_id,
        bilde,
        timestampdiff(SECOND, tid, now()) as second, 
        timestampdiff(MINUTE, tid, now()) as minute, 
        timestampdiff(HOUR, tid, now()) as hour, 
        timestampdiff(DAY, tid, now())as day, 
        timestampdiff(MONTH, tid, now())as month, 
        timestampdiff(WEEK, tid, now())as week, 
        timestampdiff(YEAR, tid, now()) as year
        from innlegg
        $ting";

    $resultat = $kobling->query( $sql );

    while ( $rad = $resultat->fetch_assoc() ) {

        $bilde = $rad[ "bilde" ];
        $innlegg_id = $rad[ "innlegg_id" ];
        $second = $rad[ "second" ];
        $minute = $rad[ "minute" ];
        $hour = $rad[ "hour" ];
        $week = $rad[ "week" ];
        $day = $rad[ "day" ];
        $month = $rad[ "month" ];
        $year = $rad[ "year" ];

        if ( $second > 59 ) {
            if ( $minute > 59 ) {
                if ( $hour > 23 ) {
                    if ( $day > 6 ) {
                        if ( $month == 0 ) {

                            echo "$week";

                        } elseif ( $month > 11 ) {

                            echo "$year år siden";

                        } else {
                            echo "$month måneder siden";
                        }

                    } else {
                        echo "$day dager siden";
                    }
                } else {
                    echo "$hour t siden";
                }
            } else {
                echo "$minute min siden";
            }
        } else {
            echo "$second s siden";
        }

        echo "<br>";

        $sql_kat = "select kategori from kategori
            where innlegg_id = $innlegg_id";

        $resultat_kat = $kobling->query( $sql_kat );

        while ( $rad_kat = $resultat_kat->fetch_assoc() ) {
            $kategori = $rad_kat[ "kategori" ];

            echo "#$kategori " ;

        }

        echo "<br><img src='images/innlegg_images/$bilde' height='300px'><br>";

    }
}
?>