<?php
include "echo_innlegg.php";
include "kobling.php";

$search = $_REQUEST[ "search" ];

$sql_rest = "from kategori
                join innlegg on kategori.innlegg_id = innlegg.innlegg_id
                join bruker ON innlegg.bruker_id = bruker.bruker_id
                where kategori.kategori = '" . $search . "'
                order by second";

echo_innlegg( $sql_rest );
?>