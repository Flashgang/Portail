<?php
if (!isset ($_SESSION["role"]))
  header('Location: index.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Portail SIO</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">-->
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/pure.css">
    <link rel="stylesheet" href="CSS/choix.css">
    <link rel="stylesheet" href="CSS/choix2.css">
    <link rel="stylesheet" href="CSS/matiere.scss">
    <script src="JS/UI.js"></script>

</head>
<body>
  <div id="layout">
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>
      <?php include "v_menu.php"; ?>
<div id="main">
    <div class="header">
        <h1>Hello World !</h1>
        <h2>Choix d'une matière</h2>
    </div>

    <div class="content">
        <p><center>           
            <!-- partial:index.partial.html -->
            <article style="--slist: #ebac79,#d65b56">
            <a href="index.php?page=cours&matiere=1">
            <h3>BLOC 1</h3>
            <p>Support et mise à disposition des SI</p>
            </article></a>

            <article style="--slist: #90cbb7,#2fb1a9">
            <a href="index.php?page=cours&matiere=2">
            <h3>BLOC 2</h3>
            <p>Conception et développement d’applications</p>
            </article></a>

            <article style="--slist: #ba69c8,#40084e">
            <a href="index.php?page=cours&matiere=3">
            <h3>BLOC 3</h3>
            <p>Cybersécurité des services informatiques</p>
            </article></a>

            <article style="--slist: #a6c869,#37a65a">
            <a href="index.php?page=cours&matiere=4">
            <h3>AP</h3>
            <p>Ateliers professionnels</p>
            </article></a>

            <article style="--slist: #ff7171,#ab0000">
            <a href="index.php?page=cours&matiere=5">
            <h3>Option</h3>
            <p>Certifications complémentaires</p>
            </article></a>

            <article style="--slist: #8a7876,#32201c">
            <a href="index.php?page=cours&matiere=8">
            <h3>Réseau</h3>
            <p>Supports réseau</p>
            </article></a>

            <!-- code modifier part theo -->
            <article style="--slist: #FBEC00,#FB9C00">
            <a href="index.php?page=cours&matiere=9">
            <h3>bachelor</h3>
            <p>Supports informatiques</p>
            </article></a>
            <!-- fin code modifier part theo -->

        </center></p>
    </div>
    <br/>
</div>
<?php include "v_bottom.php"; ?>
