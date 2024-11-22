<?php
require_once 'Modeles/m_database.php';
?>

<!DOCTYPE html>
<html>
<head>
 <title>Page modifiable</title>
 <style>
    .hidden {
      display: none;
    }
 </style>
</head>
<body>
 <h1>Titre</h1>
 <div id="contenu">Contenu</div>
 <button id="editBtn">Modifier</button>
 <button id="saveBtn" class="hidden">Enregistrer</button>
 <script src="app.js"></script>
</body>
</html>