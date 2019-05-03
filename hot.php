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

      $_SESSION["prev_site"] = basename($_SERVER['PHP_SELF']);
    ?>

    Maymays

  </body>
</html>
