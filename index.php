<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Hjem";
    include "elements/head.php";
    ?>
</head>

<body>

    <?php

    include "elements/nav.php";

    include "elements/echo_innlegg.php";

    $sql_rest = "from innlegg
                join bruker ON innlegg.bruker_id=bruker.bruker_id
                order by second";

    echo_innlegg( $sql_rest );




    ?>

</body>
</html>
