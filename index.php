<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      $Title = "Hjem | MemeHub - Nye dank memes hver uke";
      include "elements/head.php";
    ?>
  </head>
  <body>

    <?php
      $_SESSION["prev_site"] = basename($_SERVER['PHP_SELF']);
      
      include "elements/nav.php";    
    ?>

    Maymays

  </body>
</html>
