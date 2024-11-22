<?php
include "v_header.php";
?>

<div id="main">
    <div class="header">
        <?php
          echo"<h1>Hello ".$_SESSION["prenom"]." !</h1>";
        ?>
        <h2>Liens utiles</h2>
    </div>

    <div class="content">
        <h2 class="content-subhead">Projets</h2>
        <!--news importantes publiques-->
        <p>
            <li><a href="Cours/install_NotesSTMG.zip" onclick='window.open(this.href); return false;'><img src="Images/logo_calculateurstmg.png" alt="logo_note" width="25px"/> Téléchargez</a> le calculateur de moyenne du BAC STMG.</li>
        </p>
        <h2 class="content-subhead">IDE</h2>
        <p>
            <li><a href="https://visualstudio.microsoft.com/fr/free-developer-offers/">Visual studio Community</a> : l'interface de développement principale pour nos applications en C#.</li>
        </p>
        <h2 class="content-subhead">Editeur de code</h2>
        <p>
            <li><a href="https://notepad-plus-plus.org/downloads/">Notepad++</a> : l'éditeur de code de base, permet d'ouvrir rapidement et simplement tous les fichiers.</li> 
            <li><a href="https://visualstudio.microsoft.com/fr/free-developer-offers/">Visual studio Code</a> : l'éditeur de code qui permet de travailler facilement sur des gros projets.</li> 
        </p>
        <h2 class="content-subhead">Serveur web et SGBD</h2>
        <p>
            <li><a href="https://www.apachefriends.org/fr/index.html">XAMPP</a> : contient principalement un serveur apache et un SGBD.</li> 
            <li><a href="https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15">SQL Server</a> : permet de gérer n'importe quelle infrastructure SQL.</li> 
        </p>
		<h2 class="content-subhead">Documentations</h2>
        <p>
            <li><a href="https://docs.microsoft.com/fr-fr/dotnet/csharp/">MSDN C#</a> : la documentation officielle du langage C#</li> 
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/">MySQL</a> : la documentation officielle du langage MySQL</li> 
        </p>
		<h2 class="content-subhead">Bonnes pratiques et outils utiles</h2>
        <p>
            <li><a href="https://quickref.me/">QuickRef</a> : les fiches mémo rapides et utiles pour le numérique.</li> 
            <li><a href="https://cssgrid-generator.netlify.app/">CSS Grid</a> : Genère le code de vos containers en CSS pour quadriller votre site.</li> 
        </p>
    </div>
</div>
<?php include "v_bottom.php"; ?>

