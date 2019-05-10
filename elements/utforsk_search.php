<form method="POST">
        
    <input name="search" list="kategorier_brukernavn" type="text">
    <button onClick="redir('index')" type="submit"></button>
        
    <datalist id="kategorier_brukernavn">
        <?php

        $sql = "SELECT kategori, COUNT(kategori) as count FROM kategori group by kategori order by count desc;";

        $resultat = $kobling->query( $sql );

        while ( $rad = $resultat->fetch_assoc() ) {

            $kategori = $rad[ "kategori" ];

            echo "<option value='$kategori(kategori)'>";

        }
        $sql = "SELECT brukernavn FROM bruker order by brukernavn;";

        $resultat = $kobling->query( $sql );

        while ( $rad = $resultat->fetch_assoc() ) {

            $brukernavn = $rad[ "brukernavn" ];

            echo "<option value='$brukernavn(bruker)'>";

        }

        ?>
    </datalist>
    </form>