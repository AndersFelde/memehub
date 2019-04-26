<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Logg inn | MemeHub - Nye dank memes hver uke";
    include "elements/head.php";
    ?>
</head>

<body>

    <?php
    include "elements/nav.php";

    if ( isset( $_POST[ "logg_inn" ] ) ) {

        include "elements/logg_inn_sjekk.php";

    } elseif ( isset( $_SESSION[ "failed_login" ] ) ) {

        echo $_SESSION[ "failed_login" ];

        unset( $_SESSION[ "failed_login" ] );

    } elseif ( isset( $_POST[ "registrer" ] ) ) {
        
        header("Location: registrer.php");
        
    }
    ?>

    <form action="logg_inn.php" class="" method="POST">
        <label>Email</label><br>
        <input type="email" required name="email"><br>
        <label>Passord</label><br>
        <input type="password" required name="passord"><br>
        <input type="submit" value="Registrer" name="registrer">
        <input type="submit" value="Logg inn" name="logg_inn">
    </form>

</body>
</html>