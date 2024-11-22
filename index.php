<?php
session_start();
if (!isset($_GET['page']))
  $page = null;
else
  $page = $_GET['page'];
switch ($page)
	{
		case "accueil":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_accueil();
			break;
    case "utilitaires":
      require_once "Controleurs/c_main.php";
      $controleur=new c_main();
      $controleur->action_utilitaire();
      break;
    case "inscription":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_inscription();
			break;
    case "tt_inscription":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_tt_inscription($_POST['classe'],$_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['mdp']);
			break;
    case "connexion":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_connexion();
			break;
    case "tt_connexion":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_tt_connexion($_POST['mail'],$_POST['mdp']);
			break;
    case "deconnexion":
			require_once "Controleurs/c_main.php";
			$controleur=new c_main();
			$controleur->action_deconnexion();
			break;
    case "liste_users":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_liste_users();}
      break;
    case "valider_user":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_valider_user($_GET['mail']);}
      break;
    case "desac_user":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_desac_user($_GET['mail']);}
      break;
    case "supprimer_user":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_supprimer_user($_GET['mail']);}
      break;
    case "info_user":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_info_user($_GET['mail']);}
      break;
    case "account":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_account($_SESSION['mail']);
      break;
    case "modif_infos":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_modification($_POST['nom'],$_POST['prenom'],$_POST['mail'], $_POST['classe']);
      break;
    case "passage":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_passage();}
      break;
    case "liste_mails":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_admin.php";
      $controleur=new c_admin();
      $controleur->action_liste_mails();}
      break;
    case "choix_matiere":
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_matiere();
      break;
    case "cours":
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_liste_cours($_GET['matiere']);
      break;
    case "setVisible":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_setVisible($_GET['cours'], $_GET['matiere']);}
      break;
    case "setHidden":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_setHidden($_GET['cours'], $_GET['matiere']);}
      break;
    case "setVisibleCorrige":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_setVisibleCorrige($_GET['cours'], $_GET['matiere']);}
      break;
    case "setHiddenCorrige":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_setHiddenCorrige($_GET['cours'], $_GET['matiere']);}
      break;
    case "info_cours":
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_info_cours($_GET['cours']);
      break;
    case "supprimer_cours":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_supprimer_cours($_GET['cours'],$_GET['matiere']);}
      break;
    case "modif_cours":
      if($_SESSION['role'] == 3) {
      require_once "Controleurs/c_cours.php";
      $controleur=new c_cours();
      $controleur->action_modifier_cours($_POST['id'], $_POST['lib'], $_FILES['file'], $_FILES['fileCorr'], $_POST['date'], $_POST['matiere'], $_POST['classe'], $_POST['oldpath'],$_POST['oldpathCorr']);}
      break;
    case "v_ajout_cours":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_cours.php";
        $controleur=new c_cours();
        $controleur->action_form_cours();}
        break;
    case "ajout_cours":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_cours.php";
        $controleur=new c_cours();
        $controleur->action_ajout_cours($_POST['lib'], $_FILES['file'], $_FILES['fileCorr'], $_POST['date'], $_POST['matiere'], $_POST['classe']);}
        break;
    case "v_liste_fichiers":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_liste_fichier();}
        break;
    case "supprimer_fichier":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_supprimer_fichier($_GET['file']);}
        break;
    case "mentions":
        require_once "Controleurs/c_main.php";
        $controleur=new c_main();
        $controleur->action_mentions();
        break;
    case "contact":
      require_once "Controleurs/c_main.php";
      $controleur=new c_main();
      $controleur->action_contact();
      break;
    case "contact_send":
      require_once "Controleurs/c_main.php";
      $controleur=new c_main();
      $controleur->action_contact_send($_POST['mail'], $_POST['description']);
      break;
    case "password":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_user.php";
        $controleur=new c_user();
        $controleur->action_form_password();}
        break;
    case "modif_password":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_user.php";
        $controleur=new c_user();
        $controleur->action_modif_password($_POST['mdp']);}
        break;
    case "oublie":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_oublie();
      break;
    case "tt_oublie":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_tt_oublie($_POST['mail']);
      break;
    case "supprimer_compte":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_supprimer_user($_SESSION['mail']);}
        break;
    case "depot":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_cours.php";
        $controleur=new c_cours();
        $controleur->action_form_depot();}
        break;
    case "tt_depot":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_cours.php";
        $controleur=new c_cours();
        $controleur->action_tt_depot($_FILES['file']);}
        break;
    case "v_depot":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_liste_depot();}
        break;
    case "espace":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_espace();
      break;
    case "import_cloud":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_form_import_cloud();
      break;
    case "tt_depot_cloud":
      if(isset($_SESSION['role'])) {
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_tt_depot_cloud($_FILES['file']);}
      break;
    case "cloud_admin":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_cloud_admin($_GET['mail']);}
        break;
    case "dl_all_depot":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_dl_all_depot();}
        break;
    case "maj_news":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_maj_news($_POST['nouvelle']);}
        break;
    case "supprimer_news":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_supprimer_news($_GET['id']);}
        break;
    case "tt_depot_cloud_admin":
      if(isset($_SESSION['role'])) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_tt_depot_cloud_admin($_FILES['file'], $_POST["utilisateur"]);}
        break;
    case "compiler":
      require_once "Controleurs/c_user.php";
      $controleur=new c_user();
      $controleur->action_compiler();
      break;
    case "v_logs":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_panneau_logs();}
        break;
    case "dl_all_logs":
      if($_SESSION['role'] == 3) {
        require_once "Controleurs/c_admin.php";
        $controleur=new c_admin();
        $controleur->action_dl_all_logs();}
        break;
    default:
			require_once "Vues/v_landing.php";
			break;
	}
 ?>
