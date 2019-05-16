<?php
include "elements/head.php";
$title = "Hjem";
?>
</head>

<body>

    <?php    
    
    
      include "elements/nav.php";

      $bruker_id = $_SESSION["bruker_id"];
      
          
          echo "<form method='post' action='legg_til_innlegg.php'>
        <button type='submit' name='ny_inn'>Nytt innlegg</button>
    </form>";
      
    
    ?>

    <?php
    include "elements/echo_innlegg.php";

    $sql_rest = "from innlegg
                join bruker ON innlegg.bruker_id=bruker.bruker_id
                where innlegg.bruker_id = $bruker_id
                order by second";
    

    echo_innlegg( $sql_rest );
    

    ?>




</body>
</html>