<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Registrer | MemeHub - Nye dank memes hver uke";
    include "elements/head.php";
    ?>
</head>

<body>

    <?php
    include "elements/nav.php";

    if ( isset( $_POST[ "registrer" ] ) ) {

        include "elements/logg_inn_sjekk.php";

    } 
    ?>

    <form action="registrer.php" class="" method="POST">
        <label>Email</label><br>
        <input type="email" required name="email"><br>
        <label>Brukernavn</label><br>
        <input type="password" required name="brukernavn"><br>
        <label>Bilde</label><br>
        <input type="file" required name="bilde"><br>
        <label>Passord</label><br>
        <input type="password" required name="passord"><br>
        <label>Gjenta Passord</label><br>
        <input type="password" required name="passord_r"><br>
        <input type="submit" value="Registrer" name="registrer">
        <input type="submit" value="Logg inn" name="logg_inn">
    </form>

</body>
</html>