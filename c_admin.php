<?php
  require_once 'Modeles/m_user.php';
  require_once 'Modeles/m_cours.php';
  require_once 'Modeles/m_database.php';
  require_once 'Modeles/m_news.php';
  require_once 'Modeles/m_logs.php';
  require_once 'Controleurs/c_main.php';

	class c_admin
	{
		// controleur répondant aux besoins administrateurs
    private $m_user;
    private $c_main;
    private $m_cours;
    private $m_database;
    private $m_news;
    private $m_logs;
    private $msg;
    private $data;
		public function __construct()
		{
			$this->m_user = new m_user();
      $this->m_news = new m_news();
      $this->m_cours = new m_cours();
      $this->c_main = new c_main();
      $this->m_database = new m_database();
      $this->m_logs = new m_logs();
      $this->msg = null;
      $this->data = array();
		}

    public function action_liste_users()
    {
      $this->data["users"] = $this->m_user->getListeDetails();
      require_once "Vues/v_admin_users.php";
    }

    public function action_valider_user($mail)
    {
      $this->m_user->valider($mail);
      echo "<script>window.location.replace('index.php?page=liste_users')</script>";
    }

    public function action_desac_user($mail)
    {
      $this->m_user->desactiver($mail);
      echo "<script>window.location.replace('index.php?page=liste_users')</script>";
    }

    public function action_supprimer_user($mail)
    {
      $this->msg = $this->m_user->supprimer($mail);
      if ($_SESSION['role'] == 3)
        echo "<script>window.location.replace('index.php?page=liste_users')</script>";
      else
      {
        $this->m_user->deconnexion_user();
        require_once "Vues/v_msg.php";
      }

    }

    public function action_info_user($mail)
    {
      $this->data['classes'] = $this->m_cours->getClasses();
      $this->user = $this->m_user->getInfos($mail);
      require_once "Vues/v_account.php";
    }

    public function action_passage()
    {
      $this->m_user->passage();
      echo "<script>window.location.replace('index.php?page=liste_users')</script>";
    }

    public function action_liste_mails()
    {
      $this->msg = $this->m_user->generation_liste_mails();
      require_once "Vues/v_msg.php";
    }

    public function action_liste_fichier()
    {
      $this->data['files'] = $this->m_cours->getListeFile(); // objets de tyoe cours
      require_once "Vues/v_liste_fichier.php";
    }

    public function action_supprimer_fichier($file)
    {
      $this->msg = $this->m_cours->supprimer_fichier($file);
      require_once "Vues/v_msg.php";
    }

    public function action_liste_depot()
    {
      $this->data['files'] = $this->m_cours->getListeDepot(); // objets de type cours
      require_once "Vues/v_liste_fichier.php";
    }

    public function action_cloud_admin($mail)
    {
      $this->data['files'] = $this->m_user->getListeCloudEleve($mail);
      require_once "Vues/v_espace.php";
    }

    public function action_dl_all_depot()
    {
      $this->m_database->dl_alldepot();
    }
    public function action_maj_news($nouvelle)
    {
      $this->m_news->maj_news($nouvelle);
      $this->c_main->action_accueil();
    }
    public function action_supprimer_news($id)
    {
      $this->m_news->supprimer_news($id);
      $this->c_main->action_accueil();
    }
    public function action_tt_depot_cloud_admin($file, $utilisateur)
    {
      $user = $this->m_user->getInfos($utilisateur);
      $patronyme = $user->getNom().$user->getPrenom();
      $uploadDirectory = "/Cloud/".$patronyme."/";
      $this->msg = $this->m_cours->upload_to_server( $uploadDirectory , "cloud" );
      $message = "Bonjour,\n\nUn nouveau fichier a été déposé dans votre cloud par l'administrateur.\nVous pouvez le consulter en vous rendant sur le portail, rubrique 'Mon cloud'.\n\nBien à vous.\nN.Dupont";
      $this->m_user->mail_user($user->getMail(),$message,"Portail-SIO : Nouveau fichier disponible");
      require_once "Vues/v_msg.php";
    }
    public function action_panneau_logs()
    {
      $this->data["logs"] = $this->m_logs->getAllLogs();
      require_once "Vues/v_admin_logs.php";
    }
    public function action_dl_all_logs()
    {
      $this->m_database->dl_alllogs();
    }


}
