<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    include "elements/head.php";
    $title = "Hjem";
    ?>
</head>

<body>

    <?php    
      include "elements/nav.php";
    
    $_SESSION["prev_site"] = basename($_SERVER['PHP_SELF']);  

      $bruker_id = $_SESSION["bruker_id"];
      
      if(isset($_POST["ny_inn"])){
          
          include "elements/legg_til_innlegg.php";
        
      } elseif(isset($_POST["insert_inn"])){
          
          include "elements/lagre_bilde.php";

                if ( isset( $lagre_bilde ) ) {
                    
                    $sql = "insert into innlegg (bruker_id, bilde, tid) VALUES('$bruker_id', '$bilde_name_new', NOW())";

                    if ( $kobling->query( $sql ) ) {
                        
                        $bilde_dest = 'images/innlegg_images/'.$bilde_name_new;

                        move_uploaded_file( $bilde_tmp_name, $bilde_dest );
                        
                        header( "Location: bruker.php" );

                    } else {
                        echo "Det har skjedd en feil med spørringen<br>
                                $kobling->error";
                    }
                }
          
      }
    
    ?>

    <form method="post" action="bruker.php">
        <button type="submit" name="ny_inn">Nytt innlegg</button>
    </form>

    <?php


    

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
                where bruker_id = $bruker_id
                order by innlegg_id desc";

    $resultat = $kobling->query( $sql );

    while ( $rad = $resultat->fetch_assoc() ) {

        $bilde = $rad[ "bilde" ];
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

        echo "<img src='images/innlegg_images/$bilde' height='300px'><br>
                ";

    }
    ?>




</body>
</html>