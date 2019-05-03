<meta charset="utf-8">
<title><?php global $Title; echo $Title; ?></title>

<base href="<?php
$d = str_replace("\\", "/", __DIR__);
$root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d);
$root = str_replace("elements", "", $root);
echo $root;
global $root;
?>" target="_self">


<!-- Putt dette inni "href" over? Broken nå da

<php $root = "/204/elev20408/eget_arbeid/memehub/"; global $root; ?>

<php
$d = str_replace("\\", "/", __DIR__);
$root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d);
$root = str_replace("elements", "", $root);
echo $root;
global $root;
?>
-->


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


<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script defer type="text/javascript" src="scripts/activeNav.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js">
    $(document).ready(function() {
        $("#upVote").click(function() {
            var buttonValue = $("#upVote").val();
            $("#vote-msg").load("elements/insert_vote.php", {
               vote_arr: buttonValue
            });
        });
        $("#downVote").click(function() {
            var buttonValue = $("#downVote").val();
            $("#vote-msg").load("elements/insert_vote.php", {
               vote_arr: buttonValue
            });
        });
    });


</script>

<?php

session_start();

include "elements/kobling.php";



?>
