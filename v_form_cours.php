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
        <h1 class="content-subhead"><u>Cours (<?php echo $this->data['id']?>)</u></h1>
        <p>
            <form name='fm_cours' action='index.php?page=ajout_cours' enctype="multipart/form-data" method='post'>
                  Titre<br/><input type='text' name='lib' size = "50" required /><br/><br/>
                  Fichier<br/><input type='file' name='file' id="file"/><br/><br/>
                  Corrigé<br/><input type='file' name='fileCorr' id="fileCorr"/><br/><br/>
                  Date<br/><input type='date' name='date' value="<?php echo date('Y-m-d'); ?>"  required /><br/><br/>
                  Matière<br/><select name="matiere" required >

                          <?php
                            foreach($this->data['matieres'] as $mat)
                            {
                                echo "<option value=".$mat->getId().">".$mat->getLibelle()."</option>";
                            }
                           ?>
                        </select><br/><br/>
                  Niveau<br/><select name="classe" required >
                          <?php
                            foreach($this->data['classes'] as $cls)
                            {
                                echo "<option value=".$cls['id'].">".$cls['nom']."</option>";
                            }
                           ?>
                        </select><br/><br/>
                  <input type="submit" value="Ajout" class="button-secondary pure-button"/>&nbsp&nbsp
            </form>
          </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>


