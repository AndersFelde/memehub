<?php
include "kobling.php";

$vote = $_REQUEST[ "v" ];
$bruker_id = $_REQUEST[ "b" ];
$innlegg_id = $_REQUEST[ "inn" ];
$type = $_REQUEST[ "type" ];

switch ( $type ) {
    case "'norm'":
        $sql = "insert into voted (vote, innlegg_id, bruker_id)
        VALUES ($vote, $innlegg_id, $bruker_id)";
        break;
    case "'upd'":
        $sql = "update voted SET vote = $vote 
                where innlegg_id = $innlegg_id and
                bruker_id = $bruker_id";
        break;
    case "'del'":
        $sql = "delete from voted 
                where innlegg_id = $innlegg_id and
                bruker_id = $bruker_id";
}

if ( $resultat = $kobling->query( $sql ) ) {
    echo "true";
} else {
    echo $sql;
}
?>