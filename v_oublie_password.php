<?php
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Un problème ?</h1>
        <h2>Mot de passe oublié</h2>
    </div>

    <div class="content cadre">
        <p>
            <form name='fm_account' action='index.php?page=tt_oublie' method='post'>

                  Adresse mail<br/><input type='email' name='mail' size="50" required /><br/><br/>

                  <input type="submit" value="Valider" class="button-success pure-button"/>
            </form>
          </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>