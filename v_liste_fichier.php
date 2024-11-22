<?php
if (!isset ($_SESSION["role"]) || ($_SESSION["role"]) != 3)
  header('Location: index.php');
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Panneau admin</h1>
        <h2>Gestionnaire de fichiers</h2>
    </div>

    <div class="content">
        <p>
            <?php if($_GET['page'] == "v_depot") { ?>
              <center><input type="button" onclick="window.location.href = 'index.php?page=dl_all_depot';" value="Tout télécharger" class="button-secondary pure-button"/></center>&nbsp <?php } ?>
            <table border="1px" style="width:100%" class="content-table">
              <thead>
                <tr>
                  <th>Fichier</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
              if (!isset($_GET['p'])) {$_GET['p'] = 1;}
              $size = count($this->data['files']);  // code pour la pagination
              $nbpage = 1 + intdiv($size, 10);
              $start = (($_GET['p']-1)*10);
              $end = min($_GET['p']*10, $size);
              for ($i = $start ; $i < $end; $i++)
              {
                $f = new cours (null, null, null, null, null, null, null, null, null);
                $f = $this->data['files'][$i];
                echo "<tr>";
                    echo "<td style ='text-align:left'><a href='".$f->getChemin()."' onclick='window.open(this.href); return false;'><img src='".$f->getExtension($f->getChemin())."' alt='Valider'  width='40' height='40' />&nbsp".$f->getChemin()."</a></td>";
                    echo "<td><a href = 'index.php?page=supprimer_fichier&file=".$f->getChemin()."'><img src='Images/croix.png' alt='Supprimer'  width='20' height='20' /></a></td>";
                echo "</tr>";
              }
               ?>
             </tbody>
            </table>
        </p><center>
        <?php 
        $page = "v_liste_fichiers";
        if (substr($_SERVER['REQUEST_URI'], 16, 7) == "v_depot" )
              $page = "v_depot";
        for ($i = 1; $i <= $nbpage; $i++)
        { echo "<a href = 'index.php?page=".$page."&p=".$i."'/>".$i."</a>&nbsp&nbsp"; }
        ?></center>
    </div>
</div>
<?php include "v_bottom.php"; ?>