<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Utforsk";
    include "elements/head.php";
    ?>
</head>

<body>
    <?php
    include "elements/nav.php";
    if ( isset( $_POST[ "search" ] ) ) {
        $search_arr = explode( "(", $_POST[ "search" ] );
        $search = $search_arr[ "0" ];



        $sql_kategori = "select kategori from kategori where kategori = '$search'";
        $sql_bruker = "select brukernavn from bruker where brukernavn = '$search'";

        $resultat_kategori = $kobling->query( $sql_kategori );
        $resultat_bruker = $kobling->query( $sql_bruker );

        echo "$sql_kategori<br>$sql_bruker";

        if ( ( ( mysqli_num_rows( $resultat_kategori ) ) && ( mysqli_num_rows( $resultat_kategori ) ) ) > 0 ) {

            echo "Det finnes både en bruker og en kategori ved navn $search";
            echo "<form method='POST'>";
            echo "<button type='submit' value='$search' name='bruker'>Bruker: $search</button>";
            echo "<button type='submit' value='$search' name='kategori'>Kategori: $search</button>";
            echo "</form>";

        } elseif ( mysqli_num_rows( $resultat_kategori ) > 0 ) {

            include "elements/echo_innlegg.php";

            $sql_rest = "from innlegg 
                        join bruker on innlegg.bruker_id = bruker.bruker_id
                        join kategori on innlegg.innlegg_id = kategori.innlegg_id
                        where kategori = $search";

            echo_innlegg( $sql_rest );

        } elseif ( mysqli_num_rows( $resultat_bruker ) > 0 ) {

            echo "bruker";

        }
    } elseif ( isset( $_POST[ "bruker" ] ) ) {

        echo "bruker" . $_POST[ "bruker" ];


    } elseif ( isset( $_POST[ "kategori" ] ) ) {

        $search = $_POST[ "kategori" ];

        include "elements/echo_innlegg.php";

        $sql_rest = "from innlegg 
                    join bruker on innlegg.bruker_id = bruker.bruker_id
                    join kategori on innlegg.innlegg_id = kategori.innlegg_id
                    where kategori = '$search'";

        echo_innlegg( $sql_rest );
    } else {
        include "elements/utforsk_search.php";
    }


    ?>


</body>
</html>