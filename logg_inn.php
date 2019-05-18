<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Logg inn";
    include "elements/head.php";
    ?>
    
<script>
function loggInnConfirmed(brukerId){
    sessionStorage.setItem("brukerId", brukerId);
    
    window.location.href = "index.php";
    
}    
</script>
</head>

<?php
// Putta body innenfor her fordi jeg måtte



//include "elements/nav.php";

if ( isset( $_POST[ "logg_inn" ] ) ) {

    include "elements/logg_inn_sjekk.php";



    if ( isset( $loginFail ) ) {

        echo "<body>";
        echo '<div id="synd">Det var synd :(</div>';

        //echo $_SESSION["failed_login"];
        echo "<div style='display: none;' id='error'>loginError</div>";
        unset( $loginFail );
    } else {

        echo "<body onload='loggInnConfirmed(" . $_SESSION["bruker_id"] . ")'>";

        echo '<div id="synd">Det var synd :(</div>';

        echo "<div>Redirecting...</div>";
    }

} else {
    echo "<body>";
    echo '<div id="synd">Det var synd :(</div>';
}
?>
<a href="index.php" class="Material exit">clear</a>

<div class="loginWidth">
    <a href="index.php"><img src="images/logo.png" alt="MemeHub"></a>
    <div class="loginError">
        Passord eller email er feil
    </div>
    <div class="loginBox">
        <form action="logg_inn.php" class="" method="POST">
            <label>Email</label>
            <input autofocus type="email" required name="email">
            <label>Passord</label>
            <input type="password" required name="passord">
            <div class="buttonSplit">
                <button type="button" onclick="redir('registrer')">Registrer</button>
                <button type="submit" class="orange" value="Logg inn" name="logg_inn">Logg inn</button>
            </div>
        </form>
    </div>
    <a href="javascript:void(0)" class="forgotPassword">Glemt passord?</a>
</div>

</body>
</html>
