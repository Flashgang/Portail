<?php include "v_header.php"; ?>
<div id="main">
    <div class="header">
        <?php
        if (isset ($_SESSION["role"]))
          echo"<h1>Hello ".$_SESSION["prenom"]." !</h1>";
        else
          echo"<h1>Hello World !</h1>";
        ?>
        <h2>Bienvenue sur le portail SIO.</h2>
    </div>
    <div class="content">
        <!-- Panneau des news si cnx -->
        <?php
        if (isset ($_SESSION["role"]))
        {
            echo '<h2 class="content-subhead">Quoi de neuf sur le portail ?</h2>';
            echo '<p> <font color = "#29ab99"><ul>';
                foreach($this->data["news"] as $n)
                {
                    echo "<li><b>".$n->getLibelle()."</b> &nbsp";
                    if($_SESSION['role'] == 3) {echo "<a href = 'index.php?page=supprimer_news&id=".$n->getId()."'><img src='Images/croix.png' alt='Supprimer'  width='10' height='10' /></a></li>";}
                }
            echo '</ul></font></p>';
        }
        if(isset ($_SESSION["role"]) and $_SESSION['role'] == 3) {
        ?>
        <!-- Ajout de news pour l'admin -->
        <form action="index.php?page=maj_news" method="post">
            <input type="text" name="nouvelle" size="70px" maxlength="200">
            <input type="submit" value="Ajout news">
        </form>
        <?php } ?>
        <!-- accueil pour tout le monde -->
        <h2 class="content-subhead">Où suis-je ?</h2>

        <!-- modification code theo-->
        <p style="float:left"><img src="Images/qr-code.png" alt="QR code"  width="120px"  height="120px" /></p>
        <br>
        <!-- fin de code modifier part theo-->
        <p>
            Il s'agit d'un site web regroupant l'ensemble des activités qui seront parcourues par les étudiants du BTS SIO option SLAM du Lycée Edouard Gand (Amiens - 80). Ce portail a été créé par M. Dupont, responsable des enseignements informatiques du BTS.
        </p>


        <h2 class="content-subhead">Que faisons-nous ?</h2>
        <p>
            Les étudiants qui nous rejoignent chaque année n'ont pas besoin d'avoir de prérequis en informatique pour pouvoir suivre la formation. Nous reprenons les bases quoi qu'il arrive, de l'initiation à l'algorithmique jusqu'au développement de logiciels de gestion complets en passant par la création de sites web comme celui-ci et plus encore. Le tout en respectant les bonnes pratiques de cybersécurité.
        </p>

        <div class="pure-g">
            <div class="pure-u-1-4">
                <img class="pure-img-responsive" src="Images/csharp.png" alt="C#">
            </div>
            <div class="pure-u-1-4">
                <img class="pure-img-responsive" src="Images/html5.png" alt="HTML 5">
            </div>
            <div class="pure-u-1-4">
                <img class="pure-img-responsive" src="Images/sql2.png" alt="MySQL">
            </div>
            <div class="pure-u-1-4">
                <img class="pure-img-responsive" src="Images/cyber.png" alt="cybersécurité">
            </div>
        </div>

        <h2 class="content-subhead">Comment naviguer sur le portail ?</h2>
        <p>
            Le portail est réservé aux étudiants du lycée Edouard Gand en BTS SIO. Il est nécessaire de faire une demande d'inscription. Une fois cette dernière validée, l'utilisateur peut se connecter et accèder aux cours dont il a besoin.
        </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>
