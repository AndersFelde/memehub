<meta charset="utf-8">
<title>
    <?php global $Title; echo $Title; ?>
</title>

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
<meta name="theme-color" content="#F29117">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#F29117">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#F29117">


<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script defer type="text/javascript" src="scripts/activeNav.js"></script>
<script defer type="text/javascript" src="scripts/profileDropDown.js"></script>
<script defer type="text/javascript" src="scripts/errorMsgCheck.js"></script>
<script defer type="text/javascript" src="scripts/tooBad.js"></script>

<script>
    function vote( vote, b, inn ) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if ( this.readyState == 4 && this.status == 200 ) {
                document.getElementById( "voteMsg" ).innerHTML = this.responseText;
                if ( vote == 0 ) {
                    var button = document.getElementById( "downVote" );
                }
                if ( vote == 1 ) {
                    var button = document.getElementById( "upVote" );
                }

                var buttonInner = button.innerHTML;

                button.innerHTML = buttonInner + "d";
            }
        };
        console.log( "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'" );
        xmlhttp.open( "GET", "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'", true );
        xmlhttp.send();
    }
</script>

<?php

session_start();

include "elements/kobling.php";



?>
