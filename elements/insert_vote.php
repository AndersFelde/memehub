<?php 
include "kobling.php";

$vote_arr = explode(",", $_POST["vote_arr"]);

$vote = $vote_arr["0"];
$bruker_id = $vote_arr["1"];
$innlegg_id = $vote_arr["2"];



$sql = "insert into voted (vote, innlegg_id, bruker_id)
        VALUES ($vote, $innlegg_id, $bruker_id)";

if($kobling->query($sql)){
    echo "voted";
} else {
    
    echo "ikke voted";
}



?>