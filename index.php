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
      $_SESSION["prev_site"] = basename($_SERVER['PHP_SELF']);
      
      include "elements/nav.php";    
    ?>

    Maymays

  </body>
</html>
