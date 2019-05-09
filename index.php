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

    include "elements/echo_innlegg.php";

    $sql_rest = "order by innlegg_id desc";

    echo_innlegg( $sql_rest );




    ?>

</body>
</html>