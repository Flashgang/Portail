<?php
  require_once 'Modeles/m_user.php';
  require_once 'Modeles/m_news.php';
	class c_main
	{
		// controleur contenant les redirections vers l'index, l'accueil, les cnx, inscriptions et dcnx;
    private $m_user;
    private $m_news;
    private $msg;
    private $data;
		public function __construct()
		{
      $this->data = array();
			$this->m_user = new m_user();
      $this->m_news = new m_news();
      $this->msg = null;
		}
		public function action_accueil()
		{
      $this->data["news"] = $this->m_news->getAll(); // cours 1ere annee
			require_once "Vues/v_accueil.php";
		}

    public function action_inscription()
		{
			require_once "Vues/v_inscription.php";
		}

    public function action_tt_inscription($classe, $nom, $prenom, $mail, $mdp)
		{
      $verif = $this->m_user->verification($mail);
      if ($verif == 1)
      {
        $res = $this->m_user->inscription($nom, $prenom, $classe, $mail, $mdp);
        if($res != null)
          $this->msg = "La demande d'inscription a bien été envoyée.<br/>Vous recevrez un mail prochainement à l'adresse<b> ".$mail." </b>contenant sa validation ou non.";
        else
          $this->msg = "Il y a eu une erreur lors de l'inscription, veuillez contacter l'administrateur.";
      }
      else 
        $this->msg = "L'adresse mail que vous souhaitez utiliser existe déjà dans la base de données.<br/> Mail : ".$mail;
      require_once "Vues/v_msg.php";
		}

    public function action_connexion()
		{
			require_once "Vues/v_connexion.php";
		}

    public function action_deconnexion()
    {
      $this->m_user->deconnexion_user();
      require_once "Vues/v_landing.php";
    }

    public function action_tt_connexion($mail, $mdp)
		{
      $ok = false;
      $user = $this->m_user->connexion_user($mail, $mdp);
      if($user == "inactif")
        $this->msg = "Votre inscription est en cours de validation par l'administrateur.";
      else if ($user == "password")
        $this->msg = "Mot de passe incorrect.";
      else if ($user != null)
      {
        $this->msg = "Connexion réussie !<br/>Bonjour ".$user->getPrenom().".";
        $ok = true;
      }
      else
        $this->msg = "Il y a eu une erreur lors de la connexion ou l'adresse mail est inconnue, veuillez contacter l'administrateur ou réessayez.";
     require_once "Vues/v_msg.php";
     if ($ok)
        echo "<script>const myTimeout = setTimeout(Home, 1000);function Home() {window.location.replace('index.php?page=accueil');}</script>";
		}

    public function action_mentions()
    {
      require_once "Vues/v_mentions.php";
    }

    public function action_contact()
    {
      require_once "Vues/v_contact.php";
    }

    public function action_contact_send($mail, $text)
    {
      $this->msg = $this->m_user->contact_send($mail, $text);
      require_once "Vues/v_msg.php";
    }

    public function action_utilitaire()
    {
      require_once "Vues/v_utilitaires.php";
    }

  }
?>
