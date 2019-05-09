<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
      $Title = "Hot";
      include "elements/head.php";
    ?>
</head>

<body>

    <?php

    include "elements/nav.php";

    if(isset($_SESSION["bruker_id"])){

    include "elements/echo_innlegg.php";

    echo_innlegg( "hot" );
        

    } else {

        echo "<p><a href='logg_inn.php'>Logg inn</a> først du</p>";

    }




    ?>

</body>
</html>
