document.getElementById('editBtn').addEventListener('click', function() {
    var contenu = document.getElementById('contenu');
    contenu.contentEditable = true;
    contenu.focus();
     
    document.getElementById('editBtn').classList.add('hidden');
    document.getElementById('saveBtn').classList.remove('hidden');
   });
   
   document.getElementById('saveBtn').addEventListener('click', function() {
    var contenu = document.getElementById('contenu');
    contenu.contentEditable = false;
     
    document.getElementById('editBtn').classList.remove('hidden');
    document.getElementById('saveBtn').classList.add('hidden');
   });