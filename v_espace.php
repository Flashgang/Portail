<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
include "v_header.php";
$taille = 0;
foreach($this->data['files'] as $x)
{
  $taille = $taille + filesize($x->getChemin());
}
$taille = $taille/1024/1024/1024;
$taille = round($taille, 5);
?>
<div id="main">
    <div class="header">
    <h2><b>Espace utilisé : <?php echo $taille; ?> Go / 2 Go</b></h2>
    </div>
  
    <div class="content">
        <p>
          <?php if (substr($_SERVER['REQUEST_URI'], 16, 11) != "cloud_admin" ){?>
          <center><form name='fm_depot' action='index.php?page=tt_depot_cloud' enctype="multipart/form-data" method='post'><input type='file' name='file' id="file"/><input type="submit" value="Importer" class="button-success pure-button"/></form>
          <?php } ?>
        </center>
        </p>
        <p>
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
                $length = strlen('Cloud/'.$_SESSION['nom'].$_SESSION['prenom'].'/');
                echo "<tr>";
                    echo "<td style ='text-align:left'><a href='".$f->getChemin()."' onclick='window.open(this.href); return false;'><img src='".$f->getExtension($f->getChemin())."' alt='Valider'  width='40' height='40' />&nbsp".substr($f->getChemin(), $length)."</a></td>";
                    echo "<td><a href = 'index.php?page=supprimer_fichier&file=".$f->getChemin()."'><img src='Images/croix.png' alt='Supprimer'  width='20' height='20' /></a></td>";
                echo "</tr>";
              }
               ?>
             </tbody>
            </table>
        </p><center>
        <?php 
        $page = "espace";
        if (substr($_SERVER['REQUEST_URI'], 16, 11) == "cloud_admin" )
              $page = "cloud_admin&mail=".$_GET['mail'];
        for ($i = 1; $i <= $nbpage; $i++)
        { echo "<a href = 'index.php?page=".$page."&p=".$i."'/>".$i."</a>&nbsp&nbsp"; }
        ?></center>
    </div>
</div>
<?php include "v_bottom.php"; ?>