<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Mon compte</h1>
        <h2>Modification du mot de passe</h2>
    </div>

    <div class="content cadre">
        <h1 class="content-subhead"><u>Gestion de mon MDP</u></h1>
        <p>
            <form name='fm_account' action='index.php?page=modif_password' method='post'>

                  Nouveau mot de passe<br/><input type='password' name='mdp' size="40" minlength="5" maxlength="16" required /><br/><br/>

                  <input type="submit" value="Modifier" class="button-success pure-button"/>
            </form>
          </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>