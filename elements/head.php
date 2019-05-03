<meta charset="utf-8">
<title><?php global $Title; echo $Title; ?></title>

<base href="<?php $d = str_replace("\\", "/", __DIR__); $root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d); $root = str_replace("elements", "", $root); echo $root; global $root;?>" target="_self">

<link rel="stylesheet" href="styling/styling.css">
<link rel="shortcut icon" href="images/favicon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<meta name="author" content="Sander Godard, Anders Kvamme Felde">
<meta name="keywords" content="MemeHub, memehub, Memehub, dank memes, post memes, share memes">

<!-- Disse 3 meta taggene trenger du ikke røre -->
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#6C1919">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#6C1919">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#6C1919">



<script defer type="text/javascript" src="scripts/activeNav.js"></script>

<?php
session_start();

include "elements/kobling.php";

?>
