<?php
if (!isset ($_SESSION["role"]) || ($_SESSION["role"]) != 3)
header('Location: index.php');
include "v_header.php";
?>

<div id="main">
    <div class="header">
        <h1>Panneau des logs</h1>
        <?php if($_GET['page'] == "v_logs") { ?>
            
    </div>
    <br><br>
    <center><input type="button" onclick="window.location.href = 'index.php?page=dl_all_logs';" value="Télécharger logs format .txt" class="button-secondary pure-button"/></center>&nbsp <?php } ?>
    <div class="content cadre" >
        <p><center>
            <div align="left">
                <?php
                    //ajout de code pour la pagination + modification du code au niveau de l'echo
                    if (!isset($_GET['p'])) {$_GET['p'] = 1;}
                    $size = count($this->data['logs']);  // code pour la pagination
                    $nbpage = 1 + intdiv($size, 25);
                    $start = (($_GET['p']-1)*25);
                    $end = min($_GET['p']*25, $size);
                    for ($i = $start ; $i < $end; $i++)
                    {
                        echo "<b>· </b>";
                        echo $this->data["logs"][$i]->getContenu();
                        echo "<br>"; 
                    }
                ?>      
            </div>
           </center>
        </p>
        
    </div>
    <center>
        <?php 
        //ajout code pagination 
        $page = "v_admin_logs";
        if ($_GET['page'] == "v_logs")
              $page = "v_logs";
        for ($i = 1; $i <= $nbpage; $i++)
        { echo "<a href = 'index.php?page=".$page."&p=".$i."'/>".$i."</a>&nbsp&nbsp"; }
        ?>
    </center>
    </div>
<?php include "v_bottom.php"; ?>