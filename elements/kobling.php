<?php
//                               admin@localhost:3308
/*
$dbserver = "mysql.klasserom.net";
$dbuser = "knet-elev20408";
$dbpsw = "ign07";
$dbname = "knet-elev20408";

Bare bytt mellom disse Anders

Den er grei sander, og her er din forresten: 
$dbserver = "localhost";
$dbuser = "root";
$dbpsw = "";
$dbname = "MemeHub";
*/

$dbserver = "mysql.klasserom.net";
$dbuser = "knet-elev20408";
$dbpsw = "ign07";
$dbname = "knet-elev20408";

$kobling = new mysqli($dbserver, $dbuser, $dbpsw, $dbname);
global $kobling;

if ($kobling->connect_error) {
  die("Noe gikk galt: " . $kobling->connect_error);
}
$kobling->set_charset("utf8");

?>
