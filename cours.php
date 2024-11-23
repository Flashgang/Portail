<?php
class cours
{
  private $id;
  private $libelle;
  private $chemin;
  private $date;
  private $visible;
  private $matiere;
  private $classe;
  private $cheminCorrige;

  public function __construct($i, $l, $c, $cc, $d, $v, $vc, $m, $cls)
  {
    $this->id = $i;
    $this->libelle = $l;
    $this->chemin = $c;
    $this->date = $d;
    $this->visible = $v;
    $this->matiere = $m;
    $this->classe = $cls;
    $this->cheminCorrige = $cc;
    $this->visibleCorrige = $vc;
  }

  public function getId(){return $this->id;}
  public function getLibelle(){return $this->libelle;}
  public function getChemin(){return $this->chemin;}
  public function getCheminCorrige(){return $this->cheminCorrige;}
  public function getVisible(){return $this->visible;}
  public function getVisibleCorrige(){return $this->visibleCorrige;}
  public function getMatiereId(){return $this->matiere;}
  public function getClasse(){return $this->classe;}
  public function getDate(){
    $dateFR = new DateTime($this->date); //date format FR
    $dateFR = $dateFR->format('d-m-Y');
    return $dateFR;
  }
  public function getDateDM(){
    $dateFR = new DateTime($this->date); // date au format FR

// Définir la locale en français
setlocale(LC_TIME, 'fr_FR.utf8');

$dateFRFormatte = strftime('%e %B', $dateFR->getTimestamp());
return $dateFRFormatte;

  }
  public function getDateSQL()
  {
    return $this->date;
  }
  public function getExtension($pathfile)
  {
    $path = pathinfo($pathfile);
    $ext = $path['extension'];
    switch ($ext) {
      case 'pdf':
        $icon = 'Images/pdf.png';
        break;
      case 'docx':
        $icon = 'Images/word.png';
        break;
      case 'doc':
        $icon = 'Images/word.png';
        break;
      case 'exe':
        $icon = 'Images/exe.png';
        break;
      case 'zip':
        $icon = 'Images/archive.png';
        break;
      case 'rar':
        $icon = 'Images/archive.png';
        break;
      case 'csv':
        $icon = 'Images/xls.png';
        break;
      case 'xls':
        $icon = 'Images/xls.png';
        break;
      case 'xlsx':
        $icon = 'Images/xls.png';
        break;
      case 'sql':
        $icon = 'Images/sql.png';
        break;
      case 'cs':
        $icon = 'Images/cs.png';
        break;
      default:
        $icon = 'Images/doc.png';
        break;
    }
    return $icon;
  }
}
 ?>
