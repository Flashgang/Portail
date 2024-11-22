<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
?>
<script>
      // Permet d'afficher la boite de dialogue
      function confirmAction() {
        let confirmAction = confirm("Etes vous sûr de vouloir supprimer votre compte ?");
        if (confirmAction) {
          window.location.replace('index.php?page=supprimer_compte')
        } else {
          alert("Action annulée");
        }
      }
    </script>
<div id="main">
    <div class="header">
        <h1>Mon compte</h1>
        <h2>Consultation et modification de mes informations</h2>
    </div>

    <div class="content cadre">
        <h1 class="content-subhead"><u>Mes infos</u></h1>
        <p>
            <form name='fm_account' action='index.php?page=modif_infos' method='post'>
                  <?php  $_SESSION['mail_av_modif'] = $this->user->getMail(); ?>
                  Classe<br/><select name="classe" required >
                  <?php
                    foreach($this->data['classes'] as $cls)
                    {
                      if ($_SESSION["role"] != 3)
                      {
                        if($this->user->getRole() == $cls['id'])
                          echo "<option value=".$cls['id']." selected>".$cls['nom']."</option>";
                      }
                      else
                      {
                        if($this->user->getRole() == $cls['id'])
                          echo "<option value=".$cls['id']." selected>".$cls['nom']."</option>";
                        else
                          echo "<option value=".$cls['id'].">".$cls['nom']."</option>";
                      }
                    }
                   ?>
                  </select><br/><br/>
                  Nom<br/><input type='text' name='nom' value="<?php echo $this->user->getNom() ?>" maxlength="40" readonly="true" required /><br/><br/>
                  Prénom<br/><input type='text' name='prenom' value="<?php echo $this->user->getPrenom() ?>" maxlength="40" readonly="true" required /><br/><br/>
                  Mail<br/><input type='email' name='mail' size="40" value="<?php echo $this->user->getMail() ?>" maxlength="90" required /><br/><br/>

                  <input type="submit" value="Modifier" class="button-success pure-button"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <?php
                    if ($_SESSION['mail'] == $this->user->getMail() ) { ?>
                      <input type="button" value="Changer mon mot de passe" onclick="location.href='index.php?page=password'" class="button-secondary pure-button"/>
                    <?php } ?>
            </form>
          </p>
    </div>
	<?php 
	if ($_SESSION["role"] != 3) { 
		echo '<center><a id="lien" href="#" onclick="confirmAction();return false;">Supprimer mon compte</a></center>';
	} ?>
</div>
<?php include "v_bottom.php"; ?>
