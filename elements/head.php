<?php session_start();?>   
<base href="<?php $root = "/memehub/"; global $root; ?>" target="_self">


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
<script defer type="text/javascript" src="scripts/redirect.js"></script>


    <script>
        function vote( vote, b, inn ) {
            if ( vote == 1 ) {
                var type = document.getElementById( "upVote"+inn ).value;
            } else {
                var type = document.getElementById( "downVote"+inn ).value;
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    var sql = this.responseText;
                    if ( sql == "true" ) {
                        console.log( type );
                        switch ( vote ) {
                            case 1:

                                switch ( type ) {
                                    case "norm":
                                        var buttonId = "upVote";
                                        var buttonInnerText = "upvoted";
                                        var buttonOtherId = "downVote";
                                        var buttonValueSame = "del";
                                        var buttonValueOther = "upd";
                                        break;
                                    case "upd":
                                        var buttonId = "upVote";
                                        var buttonInnerText = "upvoted";
                                        var buttonValueSame = "del"

                                        var buttonOtherId = "downVote";
                                        var buttonInnerTextOther = "downvote";
                                        var buttonValueOther = "upd";

                                        document.getElementById(buttonOtherId+inn).innerHTML = buttonInnerTextOther;
                                        break;
                                    case "del":
                                        var buttonId = "upVote";
                                        var buttonInnerText = "upvote";
                                        var buttonOtherId = "downVote";
                                        var buttonValueSame = "norm";
                                        var buttonValueOther = "norm"
                                }

                                break;


                            case 0:

                                switch ( type ) {
                                    case "norm":
                                        var buttonId = "downVote";
                                        var buttonInnerText = "downvoted";
                                        var buttonOtherId = "upVote";
                                        var buttonValueSame = "del";
                                        var buttonValueOther = "upd"
                                        break;
                                    case "upd":
                                        var buttonId = "downVote";
                                        var buttonInnerText = "downvoted";
                                        var buttonValueSame = "del"

                                        var buttonOtherId = "upVote";
                                        var buttonInnerTextOther = "upvote";
                                        var buttonValueOther = "upd";

                                        document.getElementById(buttonOtherId+inn).innerHTML = buttonInnerTextOther;

                                        break;
                                    case "del":
                                        var buttonId = "downVote";
                                        var buttonInnerText = "downvote";
                                        var buttonOtherId = "upVote";
                                        var buttonValueOther = "norm";
                                        var buttonValueSame = "norm"
                                }

                                break;
                        }
                        var button = document.getElementById( buttonId+inn );
                        button.value = buttonValueSame;
                        button.innerHTML = buttonInnerText;

                        var button = document.getElementById( buttonOtherId+inn );
                        button.value = buttonValueOther;
                    } else {
                        console.log( sql );
                    }
                }
            };
            xmlhttp.open( "GET", "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'&type='" + type + "'", true );
            xmlhttp.send();
        }
    </script>
<?php 
include "elements/kobling.php";

?>