<div id="menu">
    <div class="pure-menu">
        <a class="pure-menu-heading" href="index.php">PORTAIL SIO</a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="index.php?page=accueil" class="pure-menu-link"><b><img src="Images/menu_icon/home.png" /> Accueil</b></a></li><br/>
            <?php
            if (!isset ($_SESSION["role"]))
            {
              echo '<li class="pure-menu-item"><a href="index.php?page=connexion" class="pure-menu-link"><img src="Images/menu_icon/user.png" /> Connexion</a></li>';
              echo '<li class="pure-menu-item"><a href="index.php?page=inscription" class="pure-menu-link"><img src="Images/menu_icon/info.png" /> Inscription</a></li>';
            }
            else // quand je suis connecté -------------------------------------------------------------------------------------
            {
              echo '<li class="pure-menu-item"><a href="index.php?page=choix_matiere" class="pure-menu-link"><img src="Images/menu_icon/cours.png" /> Les cours</a></li><br/>';
              echo '<li class="pure-menu-item"><a href="index.php?page=cours&matiere=7" class="pure-menu-link"><img src="Images/menu_icon/folder.png" /> Devoirs</a></li>';
              echo '<li class="pure-menu-item"><a href="index.php?page=cours&matiere=6" class="pure-menu-link"><img src="Images/menu_icon/doc.png" /> Documents</a></li>';
              echo '<li class="pure-menu-item"><a href="index.php?page=depot" class="pure-menu-link"><img src="Images/menu_icon/upload.png" /> Déposer devoir</a></li><br/>';
              echo '<li class="pure-menu-item"><a href="index.php?page=espace" class="pure-menu-link"><img src="Images/menu_icon/cloud.png" /> Mon cloud</a></li>';
              echo '<li class="pure-menu-item"><a href="index.php?page=account" class="pure-menu-link"><img src="Images/menu_icon/setting.png" /> Mon compte</a></li>';
              echo '<li class="pure-menu-item"><a href="index.php?page=deconnexion" class="pure-menu-link"><img src="Images/menu_icon/shutdown.png" /> Déconnexion</a></li>';
              // --------------------------- partie menu administrateur --------------------------------------------------------
              if ($_SESSION["role"] == 3)
              {
                echo "<br/>";
                echo '<li class="pure-menu-admin"><a href="index.php?page=liste_users" class="pure-menu-link"><img src="Images/menu_icon/ui.png" /> Utilisateurs</a></li>';
                echo '<li class="pure-menu-admin"><a href="index.php?page=v_ajout_cours" class="pure-menu-link"><img src="Images/menu_icon/document.png" /> Ajout cours</a></li>';
                echo '<li class="pure-menu-admin"><a href="index.php?page=v_liste_fichiers" class="pure-menu-link"><img src="Images/menu_icon/file.png" /> Gestion fichiers</a></li>';
                echo '<li class="pure-menu-admin"><a href="index.php?page=v_depot" class="pure-menu-link"><img src="Images/menu_icon/grid.png" /> Dépôt</a></li>';
                echo '<li class="pure-menu-admin"><a href="index.php?page=v_logs" class="pure-menu-link"><img src="Images/menu_icon/list.png" /> Logs</a></li>';
              }
            }
            ?>
            <br/>
            <li class="pure-menu-item"><a href="index.php?page=utilitaires" class="pure-menu-link"><img src="Images/menu_icon/lappy.png" /> Utilitaires</a></li>
			      <li class="pure-menu-item"><a href="index.php?page=compiler" class="pure-menu-link"><img src="Images/menu_icon/bracket.png" /> Compilateur</a></li>
            <br/>
            <li class="pure-menu-item"><a href="index.php?page=contact" class="pure-menu-link"><img src="Images/menu_icon/mail.png" /> Contact</a></li>
            <li class="pure-menu-item"><a href="index.php?page=mentions" class="pure-menu-link"><img src="Images/menu_icon/legal.png" /> Men. légales</a></li>
        </ul>
    </div>
</div>
