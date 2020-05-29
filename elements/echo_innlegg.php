<?php

function echo_innlegg( $ting ) {

    global $kobling;

    if ( isset( $_SESSION[ "bruker_id" ] ) ) {

        $bruker_id = $_SESSION[ "bruker_id" ];

    } else {
        global $bruker_id;
    }
    

    if ( isset( $bruker_id ) ) {
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
        innlegg.innlegg_id,
        brukernavn,
        IFNULL(tekst, '') as tekst,
        innlegg.bilde,
        timestampdiff(SECOND, tid, now()) as second,
        timestampdiff(MINUTE, tid, now()) as minute,
        timestampdiff(HOUR, tid, now()) as hour,
        timestampdiff(DAY, tid, now()) as day,
        timestampdiff(MONTH, tid, now()) as month,
        timestampdiff(WEEK, tid, now()) as week,
        timestampdiff(YEAR, tid, now()) as year
        $ting";


    $resultat = $kobling->query( $sql );

    echo "<div class='posts'>";

    if ( !mysqli_num_rows( $resultat ) == 0 ) {

        while ( $rad = $resultat->fetch_assoc() ) {

            $username = $rad[ "brukernavn" ];

            $bilde = $rad[ "bilde" ];
            $innlegg_id = $rad[ "innlegg_id" ];
            $tekst = $rad[ "tekst" ];
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

                                echo "$week uke siden";

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

            $sql_vote = "select
                    IFNULL(sum(vote=1), 0) as up,
                    IFNULL(sum(vote=0), 0) as down
                    from voted
                    where innlegg_id = $innlegg_id ";

            $sql_kom = "select
                    count(*) as komCon
                    from kommentar
                    where innlegg_id = $innlegg_id ";


            $rad_vote = ( $kobling->query( $sql_vote ) )->fetch_assoc();
            $rad_kom = ( $kobling->query( $sql_kom ) )->fetch_assoc();

            $upcount = $rad_vote[ "up" ];
            $downcount = $rad_vote[ "down" ];
            $commentcount = $rad_kom[ "komCon" ];


            echo "<div class='categorier'>";
            while ( $rad_kat = $resultat_kat->fetch_assoc() ) {
                $kategori = $rad_kat[ "kategori" ];

                echo "<span>#$kategori</span>";

            }
            echo "</div>";


            echo "<img id='innleggImg$innlegg_id' onerror='imgError(this);' src='images/innlegg_images/$bilde'>";
            echo "<p class='posttittel'>$tekst</p>";
            

            if ( isset( $bruker_id ) ) {


                $upvoted = false;
                $downvoted = false;

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
                if ( $upvoted == true ) {
                    echo "<button value='$func_type_up' onclick=" . '"' . "vote(1,$bruker_id,$innlegg_id)" . '"' . " class='Material icon upvoted' id='upVote$innlegg_id'>arrow_upward</button>";
                } else {
                    echo "<button value='$func_type_up' onclick=" . '"' . "vote(1,$bruker_id,$innlegg_id)" . '"' . " class='Material icon' id='upVote$innlegg_id'>arrow_upward</button>";
                }
                echo "<p id='ucount$innlegg_id' class='count'>$upcount</p>";
                echo "</div>";
                echo "<div>";
                if ( $downvoted == true ) {
                    echo "<button value='$func_type_down' onclick=" . '"' . "vote(0,$bruker_id,$innlegg_id)" . '"' . " class='Material icon downvoted' id='downVote$innlegg_id'>arrow_downward</button>";
                } else {
                    echo "<button value='$func_type_down' onclick=" . '"' . "vote(0,$bruker_id,$innlegg_id)" . '"' . " class='Material icon' id='downVote$innlegg_id'>arrow_downward</button>";
                }
                echo "<p id='dcount$innlegg_id' class='count'>$downcount</p>";
                echo "</div>";
                echo "</div>";

            } else {
                echo "<div class='postinfo'>";
                echo "<div>";
                echo "<div>";
                $new_page = '"logg_inn"';
                echo "<button onclick='redir($new_page)' class='Material icon'>arrow_upward</button>";
                echo "<p id='ucount$innlegg_id' class='count'>$upcount</p>";
                echo "</div>";
                echo "<div>";
                echo "<button onclick='redir($new_page)' class='Material icon'>arrow_downward</button>";
                echo "<p id='dcount$innlegg_id' class='count'>$downcount</p>";
                echo "</div>";
                echo "</div>";


            }
            //echo "<p id='dcount$innlegg_id' class='count'>$downcount</p>";
            //echo "</div>";
            //echo "</div>";

            echo "<div>";
            echo "<a href='javascript:void(0)' onclick='share($innlegg_id)' class='Material icon'>share</a>";
            echo "</div>";

            echo "<div>";
            echo "<p class='count'>$commentcount</p>";
            echo "<a href='#' class='Material icon'>short_text</a>";
            echo "<p class='count hidemobile'>Kommentarer</p>";
            echo "</div>";

            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "Det er desverre ingen innlegg";
    }
    echo "</div>";
}



?>