<?php

function echo_innlegg( $ting ) {

    global $kobling;

    if ( isset( $_SESSION[ "bruker_id" ] ) ) {

        $bruker_id = $_SESSION[ "bruker_id" ];

        $sql = "select vote, innlegg_id from voted
                    where bruker_id = $bruker_id";

        $resultat = $kobling->query( $sql );

        if ( mysqli_num_rows( $resultat ) > 0 ) {

            $q = 0;

            $bruker_voted_arr = array();

            while ( $rad = $resultat->fetch_assoc() ) {

                $bruker_vote = $rad[ "vote" ];
                $bruker_innlegg = $rad[ "innlegg_id" ];

                $bruker_vote_arr[ "$q" ] = "$bruker_innlegg";

                $q++;

                $bruker_vote_arr[ "$q" ] = "$bruker_vote";

                $q++;
            }
        }
    }


    $sql = "select
        innlegg_id,
        brukernavn,
        innlegg.bilde,
        timestampdiff(SECOND, tid, now()) as second,
        timestampdiff(MINUTE, tid, now()) as minute,
        timestampdiff(HOUR, tid, now()) as hour,
        timestampdiff(DAY, tid, now())as day,
        timestampdiff(MONTH, tid, now())as month,
        timestampdiff(WEEK, tid, now())as week,
        timestampdiff(YEAR, tid, now()) as year
        from innlegg
        join bruker
        where innlegg.bruker_id = bruker.bruker_id
        $ting";

    $resultat = $kobling->query( $sql );

    echo "<div class='posts'>";

    while ( $rad = $resultat->fetch_assoc() ) {

        $username = $rad[ "brukernavn" ];

        $bilde = $rad[ "bilde" ];
        $innlegg_id = $rad[ "innlegg_id" ];
        $second = $rad[ "second" ];
        $minute = $rad[ "minute" ];
        $hour = $rad[ "hour" ];
        $week = $rad[ "week" ];
        $day = $rad[ "day" ];
        $month = $rad[ "month" ];
        $year = $rad[ "year" ];


        echo "<div class='post'>";

        echo "<div class='title'>";
        echo "<h2>@$username</h2>";


        echo "<h2>";
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
        echo "</h2></div>";


        $sql_kat = "select kategori from kategori
          where innlegg_id = $innlegg_id";

        $resultat_kat = $kobling->query( $sql_kat );



        echo "<div class='categorier'>";
        while ( $rad_kat = $resultat_kat->fetch_assoc() ) {
            $kategori = $rad_kat[ "kategori" ];

            echo "<span>#$kategori</span>";

        }
        echo "</div>";

        echo "<img src='images/innlegg_images/$bilde'><br>";

        if ( isset( $_SESSION[ "bruker_id" ] ) ) {

            $bruker_id = $_SESSION[ "bruker_id" ];

            $upvoted = false;
            $downvoted = false;
            $upcount = 1;
            $downcount = 2;
            $commentcount = 3;

            if ( isset( $bruker_vote_arr ) ) {
                if ( in_array( $innlegg_id, $bruker_vote_arr ) ) {
                    $innlegg_vote = ( array_search( $innlegg_id, $bruker_vote_arr ) ) + 1;

                    $bruker_vote = $bruker_vote_arr[ "$innlegg_vote" ];


                    switch ( $bruker_vote ) {
                        case 0:

                            $func_type_up = "upd";
                            $func_type_down = "del";
                            $downvoted = true;
                            break;

                        case 1:

                            $func_type_up = "del";
                            $func_type_down = "upd";
                            $upvoted = true;
                            break;
                    }

                } else {

                    $func_type_up = "norm";
                    $func_type_down = "norm";

                }

            } else {
                $func_type_up = "norm";
                $func_type_down = "norm";
            }
            echo "<div class='postinfo'>";

              echo "<div>";
                echo "<div>";
                  if($upvoted){
                    echo "<button value='$func_type_up' onclick=" . '"' . "vote(1,$bruker_id,$innlegg_id)" . '"' . " class='Material icon upvoted' id='upVote$innlegg_id'>arrow_upward</button>";
                  } else {
                    echo "<button value='$func_type_up' onclick=" . '"' . "vote(1,$bruker_id,$innlegg_id)" . '"' . " class='Material icon' id='upVote$innlegg_id'>arrow_upward</button>";
                  }
                  echo "<p class='count'>$upcount</p>";
                echo "</div>";
                echo "<div>";
                  if($downvoted){
                    echo "<button value='$func_type_down' onclick=" . '"' . "vote(0,$bruker_id,$innlegg_id)" . '"' . " class='Material icon downvoted' id='downVote$innlegg_id'>arrow_downward</button>";
                  } else {
                    echo "<button value='$func_type_down' onclick=" . '"' . "vote(0,$bruker_id,$innlegg_id)" . '"' . " class='Material icon' id='downVote$innlegg_id'>arrow_downward</button>";
                  }
                  echo "<p class='count'>$downcount</p>";
                echo "</div>";
              echo "</div>";

              echo "<div>";
                echo "<a href='#' class='Material icon'>share</a>";
              echo "</div>";

              echo "<div>";
                echo "<p class='count'>$commentcount</p>";
                echo "<a href='#' class='Material icon'>short_text</a>";
                echo "<p class='count hidemobile'>Kommentarer</p>";
              echo "</div>";

            echo "</div>";

          echo "</div>";
        }
    }
    echo "</div>";
}



?>
