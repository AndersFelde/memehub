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
    //include "elements/nav.php";

    if ( isset( $_POST[ "logg_inn" ] ) ) {

        include "elements/logg_inn_sjekk.php";

    } elseif ( isset( $_POST[ "registrer" ] ) ) {

        header("Location: registrer.php");

    } elseif ( isset($_SESSION["failed_login"])){
        echo $_SESSION["failed_login"];
        unset($_SESSION["failed_login"]);
    }
    ?>
<a href="#" class="Material exit">clear</a>

  <div class="loginWidth">
    <a href="#"><img src="images/logo.png" alt="MemeHub"></a>
    <div class="loginError">
      Passord eller brukernavn er feil
    </div>
    <div class="loginBox">
      <form action="logg_inn.php" class="" method="POST">
        <label>Email</label>
        <input autofocus type="email" required name="email">
        <label>Passord</label>
        <input type="password" required name="passord">
        <div class="buttonSplit">
          <button type="submit" value="Registrer" name="registrer">Registrer</button>
          <button type="submit" class="orange" value="Logg inn" name="logg_inn">Logg inn</button>
        </div>
      </form>
    </div>
    <a href="#" class="forgotPassword">Glemt passord?</a>
  </div>

</body>
</html>