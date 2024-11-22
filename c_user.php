<?php
  require_once 'Modeles/m_user.php';
  require_once 'Modeles/m_cours.php';
	class c_user
	{
		// controleur répondant aux besoins utilisateurs
    private $m_user;
    private $msg;
    private $data;
    private $user;
    private $m_cours;
		public function __construct()
		{
			$this->m_user = new m_user();
      $this->m_cours = new m_cours();
      $this->msg = null;
      $this->data = array();
      $this->user = null;
		}

    public function action_account($mail)
    {
      $this->data['classes'] = $this->m_cours->getClasses();
      $this->user = $this->m_user->getInfos($mail);
      require_once "Vues/v_account.php";
    }

    public function action_modification($nom, $prenom, $mail, $classe)
    {
      $this->m_user->modification($nom, $prenom, $mail, $classe);
      echo "<script>alert('Modifications effectuées !');</script>";
      if ($_SESSION['role'] != 3)
        echo "<script>window.location.replace('index.php?page=accueil');</script>";
      else
        echo "<script>window.location.replace('index.php?page=liste_users');</script>";
    }

    public function action_form_password()
    {
      require_once "Vues/v_form_password.php";
    }

    public function action_modif_password($mdp)
    {
      $this->msg = $this->m_user->modif_password($_SESSION['mail'], $mdp);
      require_once "Vues/v_msg.php";
    }

    public function action_oublie()
    {
      require_once "Vues/v_oublie_password.php";
    }

    public function action_tt_oublie($mail)
    {
      $this->msg = $this->m_user->recovery_pwd($mail);
      require_once "Vues/v_msg.php";
    }

    public function action_espace()
    {
      $this->data['files'] = $this->m_user->getListeCloud(); // objets de type cours
      require_once "Vues/v_espace.php"; 
    }

    public function action_form_import_cloud()
    {
      require_once "Vues/v_form_cloud.php";
    }

    public function action_tt_depot_cloud()
    {
      $patronyme = $_SESSION['nom'].$_SESSION['prenom'];
      $uploadDirectory = "/Cloud/".$patronyme."/";
      $this->msg = $this->m_cours->upload_to_server( $uploadDirectory, "Cloud" );
      require_once "Vues/v_msg.php";
    }
	
	public function action_compiler()
	{
		require_once "Vues/v_compiler.php";
	}


}
