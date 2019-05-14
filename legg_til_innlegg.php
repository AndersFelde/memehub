<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    include "elements/head.php";
    $title = "Hjem";
    ?>
    <script>
        function insertKat( innleggId ) {


            var kategoriStr = window.sessionStorage.getItem( "kategoriStr" );
            if ( !( kategoriStr == ( "" || null ) ) ) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if ( this.readyState == 4 && this.status == 200 ) {
                        window.location.href = "bruker.php";
                        window.sessionStorage.removeItem( "kategoriStr" );
                    }
                };
                xmlhttp.open( "GET", "elements/insert_kategori.php?i='" + innleggId + "'&k=" + kategoriStr, true );
                xmlhttp.send();
            } else {
                window.location.href = "bruker.php";
            }
        };
    </script>

</head>

<body>

    <?php

    if ( isset( $_POST[ "insert_inn" ] ) ) {

        include "elements/lagre_bilde.php";

        if ( isset( $lagre_bilde ) ) {
            if ( isset( $_POST[ "tekst" ] ) ) {
                $tekst_sql = ", tekst";

                $tekst_ = $_POST[ "tekst" ];
                $tekst = ", '$tekst_'";
            } else {
                $tekst_sql = "";
                $tekst = "";
            }

            $sql = "insert into innlegg (bruker_id, bilde, tid" . $tekst_sql . ") VALUES('$bruker_id', '$bilde_name_new', NOW()$tekst)";

            if ( $kobling->query( $sql ) ) {

                $bilde_dest = 'images/innlegg_images/' . $bilde_name_new;

                move_uploaded_file( $bilde_tmp_name, $bilde_dest );

                $innlegg_id = $kobling->insert_id;
                //fordi den må ha "" rundt seg
                echo "<body onload='insertKat($innlegg_id)'>";
                include "elements/nav.php";
                echo '<div id="synd">Det var synd :(</div>';
                echo "<div>Redirecting...</div>";


            } else {

                echo "<body>";
                include "elements/nav.php";
                echo "Det har skjedd en feil med innlegget<br>
                                $kobling->error";
            }

        }
    } else {
        echo "<body class='postBody'>";
        include "elements/nav.php";
        echo "<h1>Legg ut en meme</h1><br>";
    }

    ?>
    <form id="form" class="newPost" action="legg_til_innlegg.php" method="post" enctype="multipart/form-data">

        <div>
          <label>Bilde</label>
          <img id="filePreview" src="">
          <input id="fileUpload" onChange="preview()" accept=".jpg, .jpeg, .png, .gif" required type="file" name="Bilde">
          <label class="BildeInput" for="Bilde">Velg en fil</label>
        </div>


        <div>
            <div>
                <label>Kategorier</label>
                <div id="nyKategoriDiv">
                </div>
                <p id="inputKategoriMld"></p>
                <input maxlength="24" onkeypress="addKategori(event)" id="inputKategori" list="kategorier" autocomplete="off" type="text" name="kategori">
                <a href="ansvar.php" class="smallink">Regler for memes og innlegg?</a>
            </div>

            <div>
                <label>Første kommentar</label>
                <!--<button id="addKategori" type="button" onclick="nyKategori()">Legg til kategori</button>-->
                <textarea name="tekst" maxlength="50" cols="30" rows="10" placeholder="Her kan du skrive inn tittelen på memen"></textarea>

                <div class="buttonSplitAgain">
                    <button type="submit" name="insert_inn">Tilbake</button>
                    <button type="submit" name="insert_inn" class="orange">Legg ut</button>
                </div>

                <datalist id="kategorier">
                    <?php

                    $sql = "SELECT kategori, COUNT(kategori) as count FROM kategori group by kategori order by count desc;";

                    $resultat = $kobling->query( $sql );

                    while ( $rad = $resultat->fetch_assoc() ) {

                        $kategori = $rad[ "kategori" ];

                        echo "<option value='$kategori'>";

                    }

                    ?>
                </datalist>
            </div>
        </div>

    </form>


    <script>
        var kat_nr = 1;
        var maxKatNr = 5;
        var kategoriArr = new Array();
        var inputK = document.getElementById( "inputKategori" );
        var pMld = document.getElementById( "inputKategoriMld" );
        var kategoriArrNew = new Array();
        var antKat = 0;


        function addKategori( event ) {
            // Number 13 is the "Enter" key on the keyboard
            if ( event.keyCode === 13 ) {
                // Cancel the default action, if needed
                event.preventDefault();


                var kategori = inputK.value.toLowerCase();
                console.log( kategori.length );

                if ( kategori.length > 1 ) {
                    if ( !kategoriArr.includes( kategori ) ) {
                        //<span id="nyKategori1"><button type="button" id="cancelButton" onclick="delKategori(1)">cancel</button></span>

                        var span = '<span class="ny_kategori" id="nyKategori' + kat_nr + '">' + kategori + '</span>';

                        var button = '<button type="button" id="cancelButton" onclick="delKategori(' + kat_nr + ')">x</button>'


                        var div = document.getElementById( "nyKategoriDiv" );

                        div.style.display = "flex";
                        div.insertAdjacentHTML( 'beforeEnd', span );
                        span = document.getElementById( "nyKategori" + kat_nr );
                        span.insertAdjacentHTML( 'beforeEnd', button );

                        //button.setAttribute( "onClick", "delKategori(" + kat_nr + ")" );

                        inputK.value = "";

                        kategoriArr[ kat_nr - 1 ] = kategori;

                        kategoriArrNewUpd();

                        //console.log( kategoriArr );

                        kat_nr++;

                        antKat++;



                        pMld.innerHTML = "";

                        if ( kat_nr > maxKatNr ) {

                            inputK.style.display = "none";
                            pMld.innerHTML = "Det holder med 5 vel?"
                        }
                    } else {
                        pMld.innerHTML = "Den finnes fra før";
                    }

                } else {
                    pMld.innerHTML = "Skriv noe du";
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
        };

        function delKategori( delKatNr ) {

            var spanDel = document.getElementById( "nyKategori" + delKatNr );
            spanDel.parentNode.removeChild( spanDel );

            kategoriArr[ delKatNr - 1 ] = "";

            //console.log( kategoriArr.join() );

            maxKatNr++;

            inputK.style.display = "block";
            pMld.innerHTML = "";

            kategoriArrNewUpd();

            antKat--;

            if ( antKat == 0 ) {
                document.getElementById( "nyKategoriDiv" ).style.display = "none";
            }


        };

        function kategoriArrNewUpd() {
            var kategoriArrNew = kategoriArr.filter( function ( item ) {

                return item !== "";

            } );
            window.sessionStorage.setItem( "kategoriStr", kategoriArrNew.join() );
            var item = window.sessionStorage.getItem( "kategoriStr" );
            console.log( item );
        };
    </script>
</body>
</html>
