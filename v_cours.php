<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
function listing($tabCours)
{?>
  <p><table border="1px" style="width:100%" class="content-table">
              <thead>
                <tr>
                  <?php if($_SESSION["role"] == 3){echo "<th></th>";}?>
                  <th>Cours</th>
                  <th>Support</th>
                  <th>Corrigé</th>
                  <th>Date</th>
                  <?php if($_SESSION["role"] == 3){echo "<th>Visibilité</th>";echo "<th>V. Corrigé</th>";}?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($tabCours as $c)
              {
                echo "<tr>";
                    if($_SESSION["role"] == 3){echo "<td><a href = 'index.php?page=info_cours&cours=".$c->getId()."'><img src='Images/loupe.png' alt='Détails'  width='20' height='20' /></a></td>";}
                    echo "<td>".$c->getLibelle()."</td>";
                    echo "<td><a href='".$c->getChemin()."' onclick='window.open(this.href); return false;'><img src='".$c->getExtension($c->getChemin())."' alt='Valider'  width='30' height='30' /></a></td>";
                    if(($c->getVisibleCorrige() == 0 and $_SESSION["role"] != 3) OR ($c->getCheminCorrige() == "Cours/" OR $c->getCheminCorrige() == "") OR (is_null(($c->getCheminCorrige()))))
                      echo "<td></td>";
                    else
                      echo "<td><a href='".$c->getCheminCorrige()."' onclick='window.open(this.href); return false;'><img src='".$c->getExtension($c->getCheminCorrige())."' alt='Valider'  width='30' height='30' /></a></td>";
                    echo "<td>".$c->getDateDM()."</td>";
                    if($_SESSION["role"] == 3)
                    {
                      if ($c->getVisible() == 0)
                          echo "<td><a href = 'index.php?page=setVisible&cours=".$c->getId()."&matiere=".$_GET['matiere']."'><img src='Images/hidden.png' alt='Caché / click rend visible'  width='60' height='30' /></a></td>";
                      else
                          echo "<td><a href = 'index.php?page=setHidden&cours=".$c->getId()."&matiere=".$_GET['matiere']."'><img src='Images/visible.png' alt='Visible / click rend caché'  width='60' height='30' /></a></td>";
                      if ($c->getVisibleCorrige() == 0)
                          echo "<td><a href = 'index.php?page=setVisibleCorrige&cours=".$c->getId()."&matiere=".$_GET['matiere']."'><img src='Images/hidden.png' alt='Caché / click rend visible'  width='60' height='30' /></a></td>";
                      else
                          echo "<td><a href = 'index.php?page=setHiddenCorrige&cours=".$c->getId()."&matiere=".$_GET['matiere']."'><img src='Images/visible.png' alt='Visible / click rend caché'  width='60' height='30' /></a></td>";
                    }
                echo "</tr>";
              }
            echo '</tbody></table></p>';
}
?>
<div id="main">
    <div class="header">
        <h1><?php echo $this->matiere; ?></h1>
        <h2>Liste des documents disponibles</h2>
    </div>

    <div class="content">
      <?php
        if (count( $this->data["cours2"]) != 0 )
        {
          //<!-- COURS DE DEUXIEME ANNEE --------------------------------------------------->
          echo '<h2 class="content-subhead">Deuxième année</h2>';
          listing($this->data["cours2"]);
        }
        if (count( $this->data["cours"]) != 0 )
        {
          //<!-- COURS DE PREMIERE ANNEE --------------------------------------------------->
          echo'<h2 class="content-subhead">Première année</h2>';
          listing($this->data["cours"]);
        } 
      ?>
    </div>
</div>
<?php include "v_bottom.php"; ?>