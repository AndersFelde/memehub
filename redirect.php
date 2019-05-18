<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <script>
        function unsetBrukerId(){
        sessionStorage.removeItem( "brukerId" );
            window.location.href = "index.php";
        }
    </script>
</head>

<body onLoad='unsetBrukerId()'>

    <?php
    session_start();

    unset( $_SESSION[ "bruker_id" ] );

    ?>

</body>
</html>