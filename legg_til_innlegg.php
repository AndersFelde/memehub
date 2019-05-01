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

    if ( isset( $_POST[ "insert_inn" ] ) ) {

        include "elements/lagre_bilde.php";

        if ( $lagre_bilde ) {

            $sql = "insert into innlegg (bruker_id, bilde, tid) VALUES('$bruker_id', '$bilde_name_new', NOW())";

            if ( $kobling->query( $sql ) ) {

                if ( !empty( $_POST[ "kategori" ] ) ) {

                    $sql = "select innlegg_id 
                    from innlegg 
                    where bilde = '$bilde_name_new'";

                    $resultat = $kobling->query( $sql );

                    $rad = $resultat->fetch_assoc();

                    $innlegg_id = $rad[ "innlegg_id" ];

                    $kategori = $_POST[ "kategori" ];

                    $sql = "insert into kategori (innlegg_id, kategori) VALUES($innlegg_id, '$kategori')";

                    if ( $kobling->query( $sql ) ) {

                        $ant_kategorier = ( count( $_POST ) ) - 1;


                        for ( $i = 1; $i < $ant_kategorier; $i++ ) {

                            $kategori_nr = "kategori" . $i;

                            $kategori = $_POST[ "$kategori_nr" ];

                            if ( !empty( $kategori ) ) {

                                $sql = "insert into kategori (innlegg_id, kategori) VALUES($innlegg_id, '$kategori')";

                                $kobling->query( $sql );
                            }

                        }

                        $bilde_dest = 'images/innlegg_images/' . $bilde_name_new;

                        move_uploaded_file( $bilde_tmp_name, $bilde_dest );

                        header( "Location: bruker.php" );

                    } else {
                        echo "Det har skjedd noe feil med kategoriene<br> $kobling->error";
                    }
                }

            } else {

                echo "Det har skjedd en feil med spørringen<br>
                                $kobling->error";
            }

        }
    }



    ?>
    <script>
        var kat_nr = 1;

        function addKategori() {

            var input = document.getElementById( "input" );

            var input_cln = input.cloneNode( true );
            input_cln.value = "";
            input_cln.name = "kategori" + kat_nr;

            var form = document.getElementById( "form" );

            var button = document.getElementById( "add_kategori" )

            var br = document.createElement( "br" );


            form.insertBefore( input_cln, button );
            form.insertBefore( br, button );

            kat_nr++;
        }
    </script>
    <form id="form" action="legg_til_innlegg.php" class="" method="post" enctype="multipart/form-data">
        <input type="file" name="bilde"><br>
        <input id="input" list="kategorier" autocomplete="off" type="text" name="kategori">
        <br><button id="add_kategori" type="button" onclick="addKategori()">Legg til kategori</button>
        <input type="submit" value="Last opp" name="insert_inn"><br>

        <datalist id="kategorier">
            <?php 
    
    $sql = "SELECT kategori, COUNT(kategori) as count FROM kategori group by kategori order by count desc;";
    
    $resultat = $kobling->query($sql);
    
    while($rad = $resultat->fetch_assoc()){
        
        $kategori = $rad["kategori"];
        
        echo "<option value='$kategori'>";
        
    }
    
    ?>
        </datalist>

    </form>
</body>
</html>