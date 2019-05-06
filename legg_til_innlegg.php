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
            if ( isset( $_POST[ "tekst" ] ) ) {
                $tekst_sql = ", tekst";

                $tekst = $_POST[ "tekst" ];
            } else {
                $tekst_sql = "";
            }

            $sql = "insert into innlegg (bruker_id, bilde, tid" . $tekst_sql . ") VALUES('$bruker_id', '$bilde_name_new', NOW())";

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

                        $uniq_post = array_unique( $_POST );

                        $ant_kategorier = ( count( $uniq_post ) ) - 1;


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
    <form id="form" action="legg_til_innlegg.php" class="" method="post" enctype="multipart/form-data">
        <img src="images/favicon.png">
        <div id="nyKategoriDiv">
            <span id="nyKategori1"></span>
        </div>
        <br>
        <input required type="file" name="bilde">
        <input id="inputKategori" list="kategorier" autocomplete="off" type="text" name="kategori">
        <!--<button id="addKategori" type="button" onclick="nyKategori()">Legg til kategori</button>-->
        <br>

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
    
    <script>
        var kat_nr = 1;

        var inputK = document.getElementById( "inputKategori" );
        console.log( inputK );
        inputK.addEventListener( "keyup", function (event) {
            // Number 13 is the "Enter" key on the keyboard
            if ( event.keyCode === 13 ) {
                // Cancel the default action, if needed
                event.preventDefault();

                var kategori = inputK.value;

                console.log( kategori );

                if ( kategori.length > 1 ) {
                    inputK.value = "";

                    console.log( "nyKategori" + kat_nr );

                    var span = document.getElementById( "nyKategori" + kat_nr );

                    kat_nr++;

                    var span_cln = span.cloneNode( true );
                    span_cln.id = "nyKategori" + kat_nr;

                    span.innerHTML = kategori;

                    var div = document.getElementById( "nyKategoriDiv" );

                    div.appendChild( span_cln );

                    inputK.placeholder = "";

                    if ( kat_nr > 5 ) {

                        document.getElementById( "addKategori" ).style.display = "none";

                        inputK.style.display = "none";

                    }
                } else {
                    inputK.placeholder = "skriv noe du";
                }

            }
        } );
    </script>
</body>
</html>