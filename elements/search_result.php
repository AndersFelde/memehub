<?php
include "kobling.php";

$search = $_REQUEST[ "search" ];

$sql_bruker = "select bruker_id, bilde from bruker where brukernavn = '$search'";


$sql_kategori = "select kategori from kategori where kategori = '$search'";



$resultat_kategori = $kobling->query( $sql_kategori );
$resultat_bruker = $kobling->query( $sql_bruker );

include "echo_innlegg.php";


if(mysqli_num_rows($resultat_bruker) > 0){
    if(mysqli_num_rows($resultat_kategori)){
        echo "<button onclick='resultKategori'>Kategori</button>";
    }
    $sql_votes = "select count(voted.voted_id) as votes from bruker 
                    join innlegg on bruker.bruker_id = innlegg.bruker_id 
                    join voted on innlegg.innlegg_id = voted.innlegg_id 
                    where brukernavn = '$search' and voted.vote = 1 group by bruker.brukernavn";
    
    
    
    $resultat_votes = $kobling->query( $sql_votes );
    
    $rad_bruker = $resultat_bruker->fetch_assoc();
    
    if(mysqli_num_rows($resultat_votes) == 0){
        $votes = 0;
    } else {
        $rad_votes = $resultat_votes->fetch_assoc();
        $votes = $rad_votes["votes"];
    }
    
    
    echo $search . "<br>";
    echo $votes . "<br>";
    echo "<img src'images/user_images/" . $rad_bruker["bilde"] . "'> <br>";
    
    $sql_rest = "from innlegg
                join bruker ON innlegg.bruker_id=bruker.bruker_id
                where innlegg.bruker_id = " . $rad_bruker["bruker_id"] .
                " order by second";
    

    echo_innlegg( $sql_rest );
} elseif(mysqli_num_rows($resultat_kategori)){
    echo "kategori";
    
    $sql_rest = "from kategori
                join innlegg on kategori.innlegg_id = innlegg.innlegg_id
                join bruker ON innlegg.bruker_id = bruker.bruker_id
                where kategori.kategori = '" . $search . "'
                order by second";
    
    echo_innlegg($sql_rest);
    
} else {
    echo "ingen resultat";
}


?>