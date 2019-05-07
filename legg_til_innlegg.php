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

        if ( isset( $lagre_bilde ) ) {
            if ( isset( $_POST[ "tekst" ] ) ) {
                $tekst_sql = ", tekst";

                $tekst = $_POST[ "tekst" ];
            } else {
                $tekst_sql = "";
            }

            $sql = "insert into innlegg (bruker_id, bilde, tid" . $tekst_sql . ") VALUES('$bruker_id', '$bilde_name_new', NOW())";

            if ( $kobling->query( $sql ) ) {

                $bilde_dest = 'images/innlegg_images/' . $bilde_name_new;

                move_uploaded_file( $bilde_tmp_name, $bilde_dest );
                
                $new_page = '"bruker"';
                //fordi den må ha "" rundt seg
                echo "<body onload='redir($new_page)'>";
                echo '<div id="synd">Det var synd :(</div>';
                echo "<div>Redirecting...</div>";

            } else {

                echo "Det har skjedd en feil med spørringen<br>
                                $kobling->error";
            }

        }
    } else {
        echo "<body>";
    }

    ?>
    <form id="form" action="legg_til_innlegg.php" class="" method="post" enctype="multipart/form-data">
        <img id="filePreview" src="">
        <div id="nyKategoriDiv">
            <span style="display:none;" id="nyKategori1"><button id="cancelButton" onclick="delKategori(1)">cancel</button></span>
        </div>
        <br>
        <input id="fileUpload" onChange="preview()" required type="file" name="bilde">
        <p id="inputKategoriMld"></p>
        <input onkeypress="addKategori(event)" id="inputKategori" list="kategorier" autocomplete="off" type="text" name="kategori">

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
        
        function addKategori( event ) {
            // Number 13 is the "Enter" key on the keyboard
            if ( event.keyCode === 13 ) {
                // Cancel the default action, if needed
                event.preventDefault();

                var inputK = document.getElementById( "inputKategori" );
                var kategori = inputK.value;
                var pMld = document.getElementById( "inputKategoriMld" );
                if ( kategori.length > 1 ) {
                    inputK.value = "";

                    var span = document.getElementById( "nyKategori" + kat_nr );
                    var button = document.getElementById("cancelButton");
                    span.style.display = "block";
                    
                    kat_nr++;

                    var span_cln = span.cloneNode( true );
                    span_cln.id = "nyKategori" + kat_nr;
                    span.style.display = "none";
                    

                    span.innerHTML = kategori+button;

                    var div = document.getElementById( "nyKategoriDiv" );

                    div.appendChild( span_cln );



                    pMld.innerHTML = "";

                    if ( kat_nr > 5 ) {

                        inputK.style.display = "none";
                        pMld.innerHTML = "Det holder med 5 vel?"



                    }
                } else {

                    pMld.innerHTML = "skriv noe du";
                }

            }
        };

        function preview() {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById( 'filePreview' );
                output.src = reader.result;
            }
            var upload = document.getElementById( "fileUpload" );
            reader.readAsDataURL( upload.files[ 0 ] );
        }
    </script>
</body>
</html>