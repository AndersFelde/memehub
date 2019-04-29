<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  </head>
  <body>
    
      <?php
      session_start();
      
      unset($_SESSION["bruker_id"]);
      
      $prev_site = $_SESSION["prev_site"];
      
      header("Location: $prev_site");
      
      ?>

  </body>
</html>
