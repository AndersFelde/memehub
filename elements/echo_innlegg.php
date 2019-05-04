<?php

function echo_innlegg( $ting ) {

    global $kobling;

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

    while ( $rad = $resultat->fetch_assoc() ) {

      $username = $rad["brukernavn"];

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

          echo "<button onclick='vote(1,$bruker_id,$innlegg_id)' class='vote' id='upVote'>upvote</button>";
          echo "<button onclick='vote(0,$bruker_id,$innlegg_id)' class='vote' id='downVote'>downvote</button>";
          echo "<p id='voteMsg'></p>";

      }
      echo "</div>";

    }
  }
?>
