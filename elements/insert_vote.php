<?php 
include "kobling.php";

$vote = $_REQUEST["v"];
$bruker_id = $_REQUEST["b"];
$innlegg_id = $_REQUEST["inn"];

$sql = "insert into voted (vote, innlegg_id, bruker_id)
        VALUES ($vote, $innlegg_id, $bruker_id)";

if($resultat = $kobling->query($sql)){
    echo "voted";
} else {
    echo mysql_error($resultat);
}
?>