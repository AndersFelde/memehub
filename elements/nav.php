<?php
  include "active.php";
?>
<nav>
  <a href="<?php echo $root; ?>" <?php global $Hjem; echo $Hjem; ?>>Hjem</a>
  <a href="nytt.php" <?php global $Nytt; echo $Nytt; ?>>Nytt</a>
  <a href="Søk/" <?php global $Søk; echo $Søk; ?>>Søk</a>
  <a href="utforsk.php" <?php global $Utforsk; echo $Utforsk; ?>>Utforsk</a>
  <a href="logg_inn.php" <?php global $Login; echo $Login; ?>>Login</a>
</nav>
