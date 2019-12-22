<?php
//                               admin@localhost:3308
$dbserver = "127.0.0.1:3308";
$dbuser = "root";
$dbpsw = "Mysql123";
$dbname = "memehub";
/*
$dbserver = "mysql.klasserom.net";
$dbuser = "knet-elev20408";
$dbpsw = "ign07";
$dbname = "knet-elev20408";


 - Bare bytt mellom disse Anders
 - Den er grei sander, og her er din forresten
 - Bare flytt kommenteringen ffs

 $dbserver = "localhost";
 $dbuser = "root";
 $dbpsw = "";
 $dbname = "MemeHub";
*/

$kobling = new mysqli($dbserver, $dbuser, $dbpsw, $dbname);
global $kobling;

if ($kobling->connect_error) {
  die("Noe gikk galt: " . $kobling->connect_error);
}
$kobling->set_charset("utf8");

?>
