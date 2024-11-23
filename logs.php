<?php
class logs {
  private $id;
  private $contenu;

  public function __construct($pid, $pcontenu)
  {
      $this->id = $pid;
      $this->contenu = $pcontenu;
  }
    public function getId(){return $this->id;}
    public function getContenu(){return $this->contenu;}
}
?>