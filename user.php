<?php
class user {
  private $nom;
  private $prenom;
  private $mail;
  private $role;
  private $mdp;
  private $statut;
  private $lastcnx;

  public function __construct($n, $p, $m, $r, $pwd, $s, $lc)
  {
    $this->nom = $n;
    $this->prenom = $p;
    $this->mail = $m;
    $this->role = $r;
    $this->mdp = $pwd;
    $this->statut = $s;
    $this->lastcnx = $lc;
  }

  public function getNom(){return $this->nom;}
  public function getPrenom(){return $this->prenom;}
  public function getMail(){return $this->mail;}
  public function getRole(){return $this->role;}
  public function getMdp(){return $this->mdp;}
  public function getStatut(){return $this->statut;}
  public function getPassage(){return $this->lastcnx;}
  public function getEspace()
  {
    $taille = 0;
    $fileList = glob("Cloud/".$this->nom.$this->prenom."/*.*");
    foreach($fileList as $fileName)
    {
        $taille = $taille + filesize($fileName); 
      
    } 
    return round($taille/1024/1024/1024,3);
  }
}
?>
