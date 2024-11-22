<?php
if (isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Inscription</h1>
        <h2>Une fois validée par l'administrateur, le portail sera accessible.</h2>
    </div>

    <div class="content cadre">
        <h1 class="content-subhead"><u>Formulaire</u></h1>
        <p>
            <form name='fm_inscription' action='index.php?page=tt_inscription' method='POST'>
                  Classe<br/>
                  <select name="classe" required >
                      <option value="1" selected="selected">TS1 SIO</option>
                      <option value="2">TS2 SIO</option>
                      <!-- code modifier part theo-->
                      <option value="5">Bachelor</option>
                      <!-- fin de code modifier part theo-->

                  </select><br/><br/>
                  Nom<br/><input type='text' name='nom' maxlength="40" required /><br/><br/>
                  Prénom<br/><input type='text' name='prenom' maxlength="40" required /><br/><br/>
                  Mail<br/><input type='email' name='mail' size="40" maxlength="90" required /><br/><br/>
                  Mot de passe<br/><input type='password' name='mdp' minlength="5" maxlength="16" required /><br/><br/>

                  <input type="submit" value="Envoyer" class="button-success pure-button"/>&nbsp&nbsp
                  <input type="reset" value="Annuler" class="button-error pure-button" />
            </form>
          </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>
