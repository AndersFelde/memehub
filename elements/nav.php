<?php
  include "active.php";
?>
<nav>
  <a href="<?php echo $root; ?>" <?php global $Hjem; echo $Hjem; ?>>Hjem</a>
  <a href="Nytt/" <?php global $Nytt; echo $Nytt; ?>>Nytt</a>
  <a href="Søk/" <?php global $Søk; echo $Søk; ?>>Søk</a>
  <a href="Utforsk/" <?php global $Utforsk; echo $Utforsk; ?>>Utforsk</a>
  <a href="Login/" <?php global $Login; echo $Login; ?>>Login</a>
</nav>
