<?php
  require_once "Modeles/m_cours.php";
  require_once "Modeles/m_user.php";
	class c_cours
	{
    private $data;
    private $m_cours;
    private $m_user;
    private $cours;
    private $msg;
		public function __construct()
		{
      $this->msg = null;
      $this->data = array();
      $this->cours = null;
      $this->m_cours = new m_cours();
      $this->m_user = new m_user();
		}

    public function action_matiere()
    {
      require_once "Vues/v_choix_matiere.php";
    }

    public function action_liste_cours($matiere)
    {
      $this->matiere = $this->m_cours->getMatiere($matiere);
      if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4)
      {
        $this->data["cours"] = $this->m_cours->getCoursAnnees($matiere, 1); // cours 1ere annee
        $this->data["cours2"] = $this->m_cours->getCoursAnnees($matiere, 2); // cours 2eme annee
      }
      else {
        $this->data["cours"] = $this->m_cours->getCoursVisibles($matiere, 1); // cours 1ere annee
        $this->data["cours2"] = $this->m_cours->getCoursVisibles($matiere, 2); // cours 2eme annee
      }
      require_once "Vues/v_cours.php";
    }

    public function action_setVisible($id_cours, $matiere)
    {
      $this->m_cours->setVisible($id_cours);
      $this->action_liste_cours($matiere);
    }

    public function action_setHidden($id_cours, $matiere)
    {
      $this->m_cours->setHidden($id_cours);
      $this->action_liste_cours($matiere);
    }
    public function action_setVisibleCorrige($id_cours, $matiere)
    {
      $this->m_cours->setVisibleCorrige($id_cours);
      $this->action_liste_cours($matiere);
    }

    public function action_setHiddenCorrige($id_cours, $matiere)
    {
      $this->m_cours->setHiddenCorrige($id_cours);
      $this->action_liste_cours($matiere);
    }

    public function action_supprimer_cours($id_cours, $matiere)
    {
      $this->m_cours->supprimer_cours($id_cours);
      $this->action_liste_cours($matiere);
    }

    public function action_info_cours($id_cours)
    {
      $this->data['matieres'] = $this->m_cours->getMatieres();
      $this->data['classes'] = $this->m_cours->getClasses();
      $this->cours = $this->m_cours->getInfos($id_cours);
      require_once "Vues/v_info_cours.php";
    }

    public function action_modifier_cours($id, $lib, $chemin, $cheminCorr, $date, $matiere, $classe, $oldpath, $oldpathCorr)
    {
      $this->m_cours->update($id, $lib, $chemin, $cheminCorr, $date, $matiere, $classe, $oldpath, $oldpathCorr);
      $this->action_matiere();
    }

    public function action_form_cours()
    {
      $this->data['matieres'] = $this->m_cours->getMatieres();
      $this->data['classes'] = $this->m_cours->getClasses();
      $this->data["id"] = $this->m_cours->getIDmax();
      require_once "Vues/v_form_cours.php";
    }

    public function action_ajout_cours($lib, $file, $fileCorr, $date, $matiere, $classe)
    {
      $this->msg = $this->m_cours->ajout($lib, $file, $fileCorr, $date, $matiere, $classe);
      require_once "Vues/v_msg.php";
    }

    public function action_form_depot()
    {
      $this->data["users"] = $this->m_user->getListeDetails();
      require_once "Vues/v_form_depot.php";
    }

    public function action_tt_depot()
    {
      $uploadDirectory = "/Depot/";
      $this->msg = $this->m_cours->upload_to_server( $uploadDirectory , "devoir" );
      require_once "Vues/v_msg.php";
    }

}
