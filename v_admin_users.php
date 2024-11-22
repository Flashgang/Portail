<?php
if (!isset ($_SESSION["role"]) || ($_SESSION["role"]) != 3)
  header('Location: index.php');
include "v_header.php";
// calcul espace cloud used
$tc = 0;
foreach($this->data["users"] as $user) {$tc += $user->getEspace();}
?>
<div id="main">
    <div class="header">
        <h1>Panneau admin</h1>
        <h2>Liste des utilisateurs</h2>
    </div>

    <div class="content"><center>
        <p>
          <?php echo "Espace total Cloud utilisé : <b>".$tc." Go</b>"; ?>&nbsp &nbsp
          <input type="button" onclick="confirm(`Êtes-vous sûr de vouloir passer à l'année suivante ?`);window.location.href = 'index.php?page=passage';" value="Passage à l'année suivante" class="button-secondary pure-button"/>&nbsp&nbsp
          <input type="button" onclick="window.location.href = 'index.php?page=liste_mails';" value="Génération liste mails" class="button-secondary pure-button"/>&nbsp &nbsp
        </p>
        <p>
            <table border="1px" style="width:100%" class="content-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Eleve</th>
                  <th>Cloud</th>
                  <th>Dernière connexion</th>
                  <th>Classe</th>
                  <th>Statut</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach($this->data["users"] as $user)
              {
                // sio 1  #def2ff // sio 2 #c5ffdc // Bachelor #006AFB // 4prof #ffdeca; // 3admin  #ffd4fe 
                switch ($user->getRole()) {
                  case 'TS1 SIO':
                    $color = "#def2ff";
                    break;
                  case 'TS2 SIO':
                    $color = "#c5ffdc";
                    break;
                    // code modifier part theo
                    case 'Bachelor':
                      $color = "#006AFB";
                      break; 
                      // fin code modifier part theo
                  case 'PROF':
                    $color = "#f7ffca";
                    break;
                  case 'ADMIN':
                    $color = "#ffd4fe";
                    break;                    
                  default:
                  $color = "white";
                    break;
                }
                if ($user->getStatut() == 0)
                  $color = "#fdc1c1";
                echo "<tr style='background-color: $color;'>";
                    echo "<td><a href = 'index.php?page=info_user&mail=".$user->getMail()."'><img src='Images/loupe.png' alt='Détails'  width='20' height='20' /></a></td>";
                    echo "<td>".$user->getNom()." ".$user->getPrenom()."</td>";
                    echo "<td><a href = 'index.php?page=cloud_admin&mail=".$user->getMail()."'>".$user->getEspace()." Go</a></td>";
                    echo "<td>".$user->getPassage()."</td>";
                    echo "<td>".$user->getRole()."</td>";
                    if ($user->getStatut() == 0)
                        echo "<td><a href = 'index.php?page=valider_user&mail=".$user->getMail()."'><img src='Images/hidden.png' alt='off'  width='60' height='30' /></a></td>";
                    else
                      {
                        if ($user->getRole() == "ADMIN")
                          echo "<td><img src='Images/visible.png' alt='on'  width='60' height='30' /></td>";
                        else
                          echo "<td><a href = 'index.php?page=desac_user&mail=".$user->getMail()."'><img src='Images/visible.png' alt='on'  width='60' height='30' /></td>";
                      } 
                    echo "<td><a href = 'index.php?page=supprimer_user&mail=".$user->getMail()."' onclick='return confirm(`Êtes-vous sûr de vouloir supprimer cet utilisateur ?`);'><img src='Images/croix.png' alt='Supprimer'  width='20' height='20' /></a></td>";
                echo "</tr>";
              }
               ?>
             </tbody>
            </table></center>
        </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>