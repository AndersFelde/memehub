<?php
//                               admin@localhost:3308
$dbserver = "mysql.klasserom.net";
$dbuser = "knet-elev20408";
$dbpsw = "ign07";
$dbname = "knet-elev20408";


//$dbserver = "mysql.klasserom.net";
//$dbuser = "knet-elev20408";
//$dbpsw = "ign07";
//$dbname = "knet-elev20408";

$kobling = new mysqli($dbserver, $dbuser, $dbpsw, $dbname);
global $kobling;

if ($kobling->connect_error) {
  die("Noe gikk galt: " . $kobling->connect_error);
}
$kobling->set_charset("utf8");

?>
