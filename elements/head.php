<meta charset="utf-8">
<title><?php global $Title; echo $Title; ?></title>

<base href="<?php $d = str_replace("\\", "/", __DIR__); $root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $d); $root = str_replace("elements", "", $root); echo $root; global $root;?>" target="_self">

<link rel="stylesheet" href="styling/styling.css">
<link rel="shortcut icon" href="images/favicon.png">

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
