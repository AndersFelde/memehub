<?php
//                               admin@localhost:3308
$dbserver = "localhost:3308";
$dbuser = "root";
$dbpsw = "Mysql123";
$dbname = "memehub";

$kobling = new mysqli($dbserver, $dbuser, $dbpsw, $dbname);
global $kobling;

if ($kobling->connect_error) {
  die("Noe gikk galt: " . $kobling->connect_error);
}
$kobling->set_charset("utf8");

?>
