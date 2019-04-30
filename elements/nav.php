<?php
include "active.php";
?>
<nav>
    <a href="<?php echo $root; ?>" <?php global $Hjem; echo $Hjem; ?>>Hjem</a>
    <a href="nytt.php" <?php global $Nytt; echo $Nytt; ?>>Nytt</a>
    <a href="Søk/" <?php global $Søk; echo $Søk; ?>>Søk</a>
    <a href="utforsk.php" <?php global $Utforsk; echo $Utforsk; ?>>Utforsk</a>

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
                <img src='images/user_images/$bilde' height='75px'>";
        
        echo "<form action='redirect.php' method='post'>";
        
        echo "<button type='submit' name='logg_ut'>Logg ut</button>";
            
        echo "</form>";
        
        
    } else {
        global $login;
        
        echo "<a href='logg_inn.php' $login> Login</a>";
    }
    
    ?>
</nav>