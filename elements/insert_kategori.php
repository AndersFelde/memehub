<?php
include "kobling.php";

if(!empty($kategori_str = $_REQUEST[ "k" ])){

$innlegg_id = $_REQUEST[ "i" ];

$kategori_arr = explode(",", $kategori_str);
    print_r($kategori_arr);
    
for ($l = 0; $l < (count($kategori_arr)); $l++){
    
    $kategori = $kategori_arr[$l];
    
    
    
    echo $kategori;
    
    $sql = "insert into kategori (kategori, innlegg_id) 
            VALUES ('$kategori', $innlegg_id)";
    
    $kobling->query($sql);
    
}    
}
?>