<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>

      <?php
      session_start();

      unset($_SESSION["bruker_id"]);

      header("Location: index.php");

      ?>

  </body>
</html>
