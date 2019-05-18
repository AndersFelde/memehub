<?php
include "kobling.php";

$search = $_REQUEST[ "search" ];

$bruker_id = $_REQUEST["brukerId"];

$sql_bruker = "select bruker_id, bilde from bruker where brukernavn = '$search'";


$sql_kategori = "select count(kategori) as count from kategori where kategori = '$search' group by kategori";



$resultat_kategori = $kobling->query( $sql_kategori );
$resultat_bruker = $kobling->query( $sql_bruker );

include "echo_innlegg.php";


if(mysqli_num_rows($resultat_bruker) > 0){
    if(mysqli_num_rows($resultat_kategori)){
        echo "<button id='resultKategori' onclick='resultKategori(" . '"' . "$search" . '"' . ")'>Vis Kategori</button>";
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
    
    echo "<div>";
    echo "<h1>Bruker</h1>";
    echo "$search <br>";
    echo "Anntall upvotes: $votes <br>";
    echo "<img width='200px' height='200px' src='images/user_images/" . $rad_bruker["bilde"] . "'> <br>";
    
    $sql_rest = "from innlegg
                join bruker ON innlegg.bruker_id=bruker.bruker_id
                where innlegg.bruker_id = " . $rad_bruker["bruker_id"] .
                " order by second";
    
    echo "<h1>Bruker Innlegg</h1>";
    echo_innlegg( $sql_rest );
    echo "</div>";
} elseif(mysqli_num_rows($resultat_kategori) > 0){
    $rad_kategori = $resultat_kategori->fetch_assoc();
    echo "<h1>kategori</h1>";
    echo "<h3>Anntall innlegg:" . $rad_kategori["count"] . "</h3>";
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