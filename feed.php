<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
      $Title = "Feed";
      include "elements/head.php";
    ?>
</head>

<body>

    <?php

    include "elements/nav.php";

    if(isset($_SESSION["bruker_id"])){

    include "elements/echo_innlegg.php";
        
    $sql_rest = ", IFNULL(sum(voted.innlegg_id=innlegg.innlegg_id), 0) as ant_votes
                from innlegg
                join voted on voted.innlegg_id = innlegg.innlegg_id
                join bruker ON innlegg.bruker_id=bruker.bruker_id
                group by innlegg_id
                order by ant_votes desc, innlegg_id desc";

    echo_innlegg( $sql_rest );
        

    } else {

        echo "<p><a href='logg_inn.php'>Logg inn</a> først du</p>";

    }




    ?>

</body>
</html>
