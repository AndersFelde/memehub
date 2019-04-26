<meta charset="utf-8">
<title><?php global $Title; echo $Title; ?></title>

<base href="<?php $d = str_replace("\\", "/", __DIR__); $root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d); $root = str_replace("elements", "", $root); echo $root; global $root;?>" target="_self">

<link rel="stylesheet" href="styling/styling.css">
<link rel="shortcut icon" href="images/favicon.png">

<script defer type="text/javascript" src="scripts/activeNav.js"></script>

<?php 
session_start();

include "elements/kobling.php";

?>
