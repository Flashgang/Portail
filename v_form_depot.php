<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Déposer un devoir</h1>
    </div>
    <div class="content cadre">
        <h1 class="content-subhead"><u>Dépot</u></h1>
        <p>
            <form name='fm_depot' action='index.php?page=tt_depot' enctype="multipart/form-data" method='post'>

                    Fichier<br/><input type='file' name='file' id="file"/><br/><br/>

                  <input type="submit" value="Soumettre" class="button-success pure-button"/>
            </form>
          </p>
    </div>
    <br/><br/>
    <?php
	if($_SESSION["role"] == 3) { ?>
    <!--réserver à l'admin-->
    <div class="header">
        <h1>Déposer un document sur un cloud</h1>
    </div>
    <div class="content cadre">
        <h1 class="content-subhead"><u>Cloud</u></h1>
        <p>
            <form name='fm_depot_cloud_admin' action='index.php?page=tt_depot_cloud_admin' enctype="multipart/form-data" method='post'>

                    Fichier<br/><input type='file' name='file' id="file"/><br/><br/>
                    Utilisateur<br/>
                    <select id="utilisateur" name="utilisateur">
                        <?php foreach ($this->data["users"] as $user): ?>
                        <option value="<?php echo $user->getMail(); ?>"><?php echo $user->getNom()." ".$user->getPrenom() ?></option>
                        <?php endforeach; ?>
                    </select><br/><br/>

                  <input type="submit" value="Soumettre" class="button-success pure-button"/>
            </form>
          </p>
    </div>
	<?php } ?>
</div>
<?php include "v_bottom.php"; ?>