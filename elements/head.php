<?php session_start();?>
<base href="
    <?php
    $d = str_replace("\\", "/", __DIR__);
    $root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d);
    $root = str_replace("elements", "", $root);
    echo $root;
    global $root;
    ?>
    " target="_self">


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

    <title><?php global $Title; echo $Title . " | MemeHub - Nye dank memes hver uke"; ?></title>

<link rel="stylesheet" href="styling/styling.css">
<link rel="shortcut icon" href="images/favicon.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
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
    <script defer type="text/javascript" src="scripts/bildeInput.js"></script>
    <script type="text/javascript" src="scripts/redirect.js"></script>


<script>
    function vote( vote, b, inn ) {
        if ( vote == 1 ) {
            var type = document.getElementById( "upVote" + inn ).value;
        } else {
            var type = document.getElementById( "downVote" + inn ).value;
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if ( this.readyState == 4 && this.status == 200 ) {
                var sql = this.responseText;
                if ( sql == "true" ) {
                    var ucount = document.getElementById( "ucount" + inn );
                    var dcount = document.getElementById( "dcount" + inn );
                    switch ( vote ) {
                        case 1:



                            switch ( type ) {
                                case "norm":
                                    var buttonId = "upVote";
                                    var buttonStyle = "#F29117";
                                    var buttonOtherId = "downVote";
                                    var buttonValueSame = "del";
                                    var buttonValueOther = "upd";
                                    ucount.innerHTML = parseInt( ucount.innerHTML ) + 1;
                                    break;
                                case "upd":
                                    var buttonId = "upVote";
                                    var buttonStyle = "#F29117";
                                    var buttonValueSame = "del"

                                    var buttonOtherId = "downVote";
                                    var buttonStyleOther = "#9F9F9F";
                                    var buttonValueOther = "upd";
                                    ucount.innerHTML = parseInt( ucount.innerHTML ) + 1;
                                    dcount.innerHTML = parseInt( dcount.innerHTML ) - 1;


                                    document.getElementById( buttonOtherId + inn ).style.color = buttonStyleOther;
                                    break;
                                case "del":
                                    var buttonId = "upVote";
                                    var buttonStyle = "#9F9F9F";
                                    var buttonOtherId = "downVote";
                                    var buttonValueSame = "norm";
                                    var buttonValueOther = "norm"
                                    ucount.innerHTML = parseInt( ucount.innerHTML ) - 1;
                            }

                            break;


                        case 0:




                            switch ( type ) {
                                case "norm":
                                    var buttonId = "downVote";
                                    var buttonStyle = "#033F61";
                                    var buttonOtherId = "upVote";
                                    var buttonValueSame = "del";
                                    var buttonValueOther = "upd"
                                    dcount.innerHTML = parseInt( dcount.innerHTML ) + 1;
                                    break;
                                case "upd":
                                    var buttonId = "downVote";
                                    var buttonStyle = "#033F61";
                                    var buttonValueSame = "del"

                                    var buttonOtherId = "upVote";
                                    var buttonStyleOther = "#9F9F9F";
                                    var buttonValueOther = "upd";

                                    document.getElementById( buttonOtherId + inn ).style.color = buttonStyleOther;

                                    dcount.innerHTML = parseInt( dcount.innerHTML ) + 1;
                                    ucount.innerHTML = parseInt( ucount.innerHTML ) - 1;
                                    break;
                                case "del":
                                    var buttonId = "downVote";
                                    var buttonStyle = "#9F9F9F";
                                    var buttonOtherId = "upVote";
                                    var buttonValueOther = "norm";
                                    var buttonValueSame = "norm"
                                    dcount.innerHTML = parseInt( dcount.innerHTML ) - 1;
                            }

                            break;
                    }
                    var button = document.getElementById( buttonId + inn );
                    button.value = buttonValueSame;
                    button.style.color = buttonStyle;

                    var button = document.getElementById( buttonOtherId + inn );
                    button.value = buttonValueOther;
                } else {
                    console.log( "feil: " + sql );
                }
            }
        };
        xmlhttp.open( "GET", "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'&type='" + type + "'", true );
        xmlhttp.send();
    }
    function imgError(image) {
	        image.onerror = "";
		    image.src = "images/logo.png";
		    return true;
    }

</script>

<?php
include "elements/kobling.php";

    ?>
