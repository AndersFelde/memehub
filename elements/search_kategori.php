<?php
$bruker_id = $_REQUEST["brukerId"];
include "echo_innlegg.php";
include "kobling.php";
$search = $_REQUEST[ "search" ];
$sql_kategori = "select count(kategori) as count from kategori where kategori = '$search' group by kategori";
$resultat_kategori = $kobling->query( $sql_kategori );
$rad_kategori = $resultat_kategori->fetch_assoc();


echo "<h1>kategori</h1>";
echo "<h3>Anntall innlegg:" . $rad_kategori[ "count" ] . "</h3>";
$sql_rest = "from kategori
                join innlegg on kategori.innlegg_id = innlegg.innlegg_id
                join bruker ON innlegg.bruker_id = bruker.bruker_id
                where kategori.kategori = '" . $search . "'
                order by second";

echo_innlegg( $sql_rest );
?>