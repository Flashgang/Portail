<?php
if (isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Connexion</h1>
        <h2>Possible uniquement si votre inscription a été validée.</h2>
    </div>

    <div class="content cadre">
        <p><center>
            <form name='fm_connexion' action='index.php?page=tt_connexion' method='POST'>
                  Adresse mail &nbsp&nbsp <input type='email' name='mail' size="40" required/><br/><br/>
                  Mot de passe &nbsp <input type='password' name='mdp' minlength="5" size="40" required/><br/><br/>
                  <input type="submit" value="Se connecter" class="button-success pure-button"/>&nbsp&nbsp
                  <input type="reset" value="Annuler" class="button-error pure-button" />
            </form></center>
          </p>
    </div>
    <center><a href="index.php?page=oublie">Mot de passe oublié ?</a></center>
<?php include "v_bottom.php"; ?>
