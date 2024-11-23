<?php
class news {
  private $id;
  private $libelle;

  public function __construct($pid, $plib)
  {
      $this->id = $pid;
      $this->libelle = $plib;
  }
    public function getId(){return $this->id;}
    public function getLibelle(){return $this->libelle;}
}
 ?>
