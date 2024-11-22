<?php
if (!isset ($_SESSION["role"]) || $_SESSION["role"] != 3)
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Info cours</h1>
        <h2>Consultation et modification d'un cours</h2>
    </div>

    <div class="content cadre">
        <h1 class="content-subhead"><u>Cours</u></h1>
        <p>
            <?php echo "<form name='fm_cours' action='index.php?page=modif_cours' enctype='multipart/form-data' method='post'>" ?>
                  ID<br/><input type='text' name='id' value="<?php echo $this->cours->getId() ?>" required disabled/><br/><br/>
                  Titre<br/><input type='text' name='lib' value="<?php echo $this->cours->getLibelle() ?>" size = "50" required /><br/><br/>

                  Nouveau fichier<br/><input type='file' name='file' id="file" /><br/><br/>
                  Chemin actuel <br/><input type='text' name='oldpath' value="<?php echo $this->cours->getChemin() ?>" size = "50"  readonly="true" required /><br/><br/>

                  Nouveau corrigé<br/><input type='file' name='fileCorr' id="fileCorr" /><br/><br/>
                  Chemin corrigé <br/><input type='text' name='oldpathCorr' value="<?php echo $this->cours->getCheminCorrige() ?>" size = "50"  readonly="true" required /><br/><br/>

                  Date<br/><input type='date' name='date' value="<?php echo $this->cours->getDateSQL() ?>" required /><br/><br/>
                  Matière<br/><select name="matiere" required >
                          <?php
                            foreach($this->data['matieres'] as $mat)
                            {
                              if ($mat->getId() == $this->cours->getMatiereId())
                                echo "<option value=".$mat->getId()." selected>".$mat->getLibelle()."</option>";
                              else
                                echo "<option value=".$mat->getId().">".$mat->getLibelle()."</option>";
                            }
                           ?>
                        </select><br/><br/>
                  Niveau<br/><select name="classe" required >
                          <?php
                            foreach($this->data['classes'] as $cls)
                            {
                              if ($cls['id'] == $this->cours->getClasse())
                                echo "<option value=".$cls['id']." selected>".$cls['nom']."</option>";
                              else
                                echo "<option value=".$cls['id'].">".$cls['nom']."</option>";
                            }
                           ?>
                        </select>
                  <input type='hidden' name='id' value="<?php echo $this->cours->getId() ?>"/><br/><br/>
                  <input type="submit" value="Modifier" class="button-secondary pure-button"/>&nbsp&nbsp
            </form>
          </p>
    </div>
    <center><?php echo "<td><a href = 'index.php?page=supprimer_cours&cours=".$this->cours->getId()."&matiere=".$this->cours->getMatiereId()."'>Supprimer ce cours</a></td>"; ?></center>
</div>
<?php include "v_bottom.php"; ?>