<?php
include "active.php";
?>
<nav>
  <div>
    <a href="<?php echo $root; ?>" <?php global $Feed; echo $Feed; ?> class="nopadding"><img src="<?php echo $root; ?>images/logo.png"></a>
    <a href="<?php echo $root; ?>Feed.php" <?php global $Feed; echo $Feed; ?>>Feed</a>
    <a href="<?php echo $root; ?>Hot.php" <?php global $Hot; echo $Hot; ?>>Hot</a>
    <a href="<?php echo $root; ?>Utforsk.php" <?php global $Utforsk; echo $Utforsk; ?>>Utforsk</a>
  </div>
  <div>
    <?php

    if(isset($_SESSION["bruker_id"])){

        $bruker_id = $_SESSION["bruker_id"];

        $sql = "select brukernavn, bilde
                from bruker
                where bruker_id = '$bruker_id'";

        $resultat = $kobling->query($sql);

        $rad = $resultat->fetch_assoc();

        $brukernavn = $rad["brukernavn"];
        $bilde = $rad["bilde"];

        echo "<a href='bruker.php'>$brukernavn</a>
              <img src='images/user_images/$bilde' class='navProfilePicture'>";

        echo "<form action='redirect.php' method='post'>";

        echo "<button type='submit' name='logg_ut'>Logg ut</button>";

        echo "</form>";


    } else {
        global $login;

        echo "<a href='logg_inn.php' $login> Login</a>";
    }

    ?>
  </div>
</nav>
