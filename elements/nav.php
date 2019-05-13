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

        echo "
        <div class='ddsystem'>
          <a href='javascript:void(0)' id='user'>
            $brukernavn
            <img src='images/user_images/$bilde' class='navProfilePicture'>
          </a>
          <div class='dropdownProfile'>
            <div>
              <a href='bruker.php'>
                <p>Profil</p>
                <p class='Material'>supervisor_account</p>
              </a>

              <a href='#'>
                <p>Likt</p>
                <p class='Material'>arrow_upward</p>
              </a>

              <a href='#'>
                <p>Kommentarer</p>
                <p class='Material'>short_text</p>
              </a>
            </div>



            <div>
              <a href='#'>
                <p>Innstillinger</p>
                <p class='Material'>settings</p>
              </a>

              <form action='redirect.php' method='post'>
                <button type='submit' name='logg_ut'>
                  <p>Logg ut</p>
                  <p class='Material'>exit_to_app</p>
                </button>
              </form>

            </div>



          </div>
        </div>
        ";


    } else {
        global $login;

        echo "<a href='logg_inn.php' $login> Login</a>";
    }

    ?>
  </div>

</nav>
<a class="plussInnlegg" href="legg_til_innlegg.php">+</a>
