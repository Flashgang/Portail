<?php
require_once "Classes/cours.php";
require_once "Classes/matiere.php";
require_once "m_database.php";
class m_cours extends m_database
{
  public function getCours($matiere)
  {
    $liste = array();
    $this->connexion();
    $req="select * from cours where id_mat_cours = '".$matiere."' order by date desc;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne) // user actif
    {
      $cours=new cours($ligne["id_cours"],$ligne["lib_cours"],$ligne["chemin"],$ligne["corrige"],$ligne["date"],$ligne["visible"], $ligne["visibleCorrige"], $ligne["id_mat_cours"], $ligne['id_classe']);
      $liste[]=$cours;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  public function getMatiere($matiere)
  {
    $this->connexion();
    $req="select lib_mat from matiere where id_mat = ".$matiere.";";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    if($ligne) // user actif
    {
      $matiere = $ligne['lib_mat'];
    }
    $this->deconnexion();
    return $matiere;
  }

  public function getCoursAnnees($matiere, $annee)
  {
    $liste = array();
    $this->connexion();
    $req="select * from cours where id_mat_cours = '".$matiere."' AND id_classe = ".$annee." order by date desc;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne)
    {
      $cours=new cours($ligne["id_cours"],$ligne["lib_cours"],$ligne["chemin"],$ligne["corrige"],$ligne["date"],$ligne["visible"], $ligne["visibleCorrige"],$ligne["id_mat_cours"], $ligne['id_classe']);
      $liste[]=$cours;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  public function getCoursVisibles($matiere, $annee)
  {
    $liste = array();
    $this->connexion();
    $req="select * from cours where id_mat_cours = '".$matiere."' AND id_classe = ".$annee." and visible = 1 order by date desc;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne)
    {
      $cours=new cours($ligne["id_cours"],$ligne["lib_cours"],$ligne["chemin"],$ligne["corrige"],$ligne["date"],$ligne["visible"], $ligne["visibleCorrige"],$ligne["id_mat_cours"], $ligne['id_classe']);
      $liste[]=$cours;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  public function setVisible($id_cours)
  {
    $this->connexion();
    $req="update cours set visible = 1 where id_cours = ".$id_cours.";";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    //cours
    $cours = $this->getInfos($id_cours);
    //date de la modif
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $dateSTR = strftime("%e %B %Y : ");
    //recup nom du bloc
    $this->connexion();
    $req2="select matiere.lib_mat from matiere where matiere.id_mat =".$cours->getMatiereId().";";
    $res2=mysqli_query($this->GetCnx(), $req2);
    $libMatiere = mysqli_fetch_assoc($res2);
    $this->deconnexion();
    //construction du contenu
    $this->connexion();
    $contenu = "'".$dateSTR."Ajout du utilaitaire ".$cours->getLibelle()." dans <a href=\"index.php?page=cours&matiere=".$cours->getMatiereId()."\">".$libMatiere["lib_mat"]."</a>";
    $req3="insert into `news` (`news_id`, `contenu`) VALUES (NULL,".$contenu."');";
    mysqli_query($this->GetCnx(), $req3);
    $this->deconnexion();
  }

  public function setHidden($id_cours)
  {
    $this->connexion();
    $req="update cours set visible = 0 where id_cours = ".$id_cours.";";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
  }

  public function setVisibleCorrige($id_cours)
  {
    $this->connexion();
    $req="update cours set visibleCorrige = 1 where id_cours = ".$id_cours.";";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    //cours
    $cours = $this->getInfos($id_cours);
    //date de la modif
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $dateSTR = strftime("%e %B %Y : ");
    //recup nom du bloc
    $this->connexion();
    $req2="select matiere.lib_mat from matiere where matiere.id_mat =".$cours->getMatiereId().";";
    $res2=mysqli_query($this->GetCnx(), $req2);
    $libMatiere = mysqli_fetch_assoc($res2);
    $this->deconnexion();
    //construction du contenu
    $this->connexion();
    $contenu = "'".$dateSTR."Ajout du corrigé ".$cours->getLibelle()." dans <a href=\"index.php?page=cours&matiere=".$cours->getMatiereId()."\">".$libMatiere["lib_mat"]."</a>";
    $req3="insert into `news` (`news_id`, `contenu`) VALUES (NULL,".$contenu."');";
    mysqli_query($this->GetCnx(), $req3);
    $this->deconnexion();
  }

  public function setHiddenCorrige($id_cours)
  {
    $this->connexion();
    $req="update cours set visibleCorrige = 0 where id_cours = ".$id_cours.";";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
  }

  public function supprimer_cours($id_cours)
  {
    $path = $this->getInfos($id_cours)->getChemin();
    $this->connexion();
    $req="delete from cours where id_cours = ".$id_cours.";";    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    $this->supprimer_fichier($path);
  }

  public function getInfos($id_cours)
  {
    $cours = null;
    $this->connexion();
    $req="select * from cours where id_cours = ".$id_cours.";";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    if($ligne) // user actif
    {
      $cours=new cours($ligne["id_cours"],$ligne["lib_cours"],$ligne["chemin"], $ligne["corrige"],$ligne["date"],$ligne["visible"],$ligne["visibleCorrige"], $ligne["id_mat_cours"], $ligne['id_classe']);
    }
    $this->deconnexion();
    $this->write_logs($_SESSION['mail']." a tenté de supprimer le cours n°".$id_cours);
    return $cours;
  }

  public function getClasses()
  {
    $liste = array();
    $this->connexion();
    $req="select * from role;;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne)
    {
      $liste[]=['id' => $ligne['role_id'], 'nom' => $ligne['role_lib']];
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  public function getMatieres()
  {
    $liste = array();
    $this->connexion();
    $req="select * from matiere;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne)
    {
      $matiere = new matiere($ligne['id_mat'],$ligne['lib_mat']);
      $liste[]=$matiere;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  public function update($id, $lib, $file, $fileCorr, $date, $matiere, $classe, $oldpath, $oldpathCorr)
  {
    if ($file['name'] == "")
      $file = $oldpath;
    else
    {
      $this->supprimer_fichier($oldpath);
      $file = "Cours/".$file['name'];
      $uploadDirectory = "/Cours/";
      $this->upload_to_server($uploadDirectory, "cours");
    }
    if ($fileCorr['name'] == "")
      $fileCorr = $oldpathCorr;
    else
    {
      $this->supprimer_fichier($oldpathCorr);
      $fileCorr = "Cours/".$fileCorr['name'];
      $uploadDirectory = "/Cours/";
      $this->upload_to_server($uploadDirectory, "cours");
    }
    $this->connexion();
    $req = "update cours SET lib_cours = '".$lib."', chemin = '".$file."', corrige = '".$fileCorr."', date = '".$date."', id_mat_cours = ".$matiere.", id_classe = ".$classe." where id_cours = ".$id.";";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    $this->write_logs($_SESSION['mail']." a essayé de mettre à jour le fichier ".$id.$file);
  }

  public function ajout($lib, $file, $fileCorr, $date, $matiere, $classe)
  {
    $this->connexion();
    $reqCount = "select max(id_cours) as nb from cours;";
    $resCount = mysqli_query($this->GetCnx(), $reqCount);
    $this->deconnexion();
    $ligne = mysqli_fetch_assoc($resCount);
    $id = $ligne['nb'];
    $id++;
	  $file = "Cours/".$file['name'];
    $fileCorr = "Cours/".$fileCorr['name'];
    $uploadDirectory = "/Cours/";
    $msg = $this->upload_to_server($uploadDirectory, "cours");
    $req = "insert into cours values (".$id.", '".$lib."', '".$file."', '".$fileCorr."', '".$date."', 0, 0, ".$matiere.", ".$classe.");";
    $this->connexion();
    $res =  mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    $this->write_logs($_SESSION['mail']." a tenté d\'ajouter un cours ".$id." ".$file);
    return $msg;
  }

  public function upload_to_server($uploadDirectory, $case)
  {
    $msg = "";
    $currentDirectory = getcwd();
    $errors = []; // Store errors here
    $fileExtensionsAllowed = [ 'txt', 'cs', 'sql', 'pdf', 'xls', 'xlsx', 'csv', 'doc', 'docx', 'zip', 'rar', 'exe', 'html', 'php', 'odt']; // These will be the only file extensions allowed 
    if (count($_FILES) != 1) // upload plusieurs fichiers
    {
      foreach ($_FILES as $f)
      {
        $fileName = $f['name'];
        $fileSize = $f['size'];
        if ($fileSize != 0)
        {
          
          $fileTmpName  = $f['tmp_name'];
          $fileType = $f['type'];
          $path = pathinfo($fileName);
          $fileExtension =  $path['extension'];

          if ($_SESSION['role'] != 3 && $case == "devoir")
            $fileName = $_SESSION['nom']. "_" . $_SESSION['prenom']. "." . $fileExtension;

          $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

          if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "Extension non autorisée, veuillez uploader un fichier : 'odt', 'txt', 'cs', 'sql', 'xls', 'pdf', 'xlsx', 'csv', 'doc', 'docx', 'zip', 'rar', 'exe', 'html', 'php' file.";
          }

          if ($fileSize > 136314880) // 130M sur OVH 8M sur apache
          {
            $errors[] = "Le fichier dépasse la taille maximale autorisée (130Mo)";
          }
          if ($case == "Cloud" && (($this->TailleDossier($uploadDirectory) + $fileSize) > 2147483648))
          {
            $errors[] = "Votre espace va dépasser 2 Go.";
          } 
          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
      
            if ($didUpload) {
              $msg .= "Le fichier " . basename($fileName) . " a été importé sur le serveur.<br/>";
            } else {
              $msg .= "Il y a eu une erreur. Contacter l'admin.";
            }
          } else {
            foreach ($errors as $error) {
              $msg .= $error . "\n";
            }}
        }
      }
    }  
    else
    {
      $fileName = $_FILES['file']['name'];
      $fileSize = $_FILES['file']['size'];
      $fileTmpName  = $_FILES['file']['tmp_name'];
      $fileType = $_FILES['file']['type'];
      $path = pathinfo($fileName);
      $fileExtension =  $path['extension'];
  
      if ($_SESSION['role'] != 3 && $case == "devoir")
        $fileName = $_SESSION['nom']. "_" . $_SESSION['prenom']. "." . $fileExtension;
  
      $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
  
      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "Extension non autorisée, veuillez uploader un fichier : 'odt', 'txt', 'cs', 'sql', 'xls', 'pdf', 'xlsx', 'csv', 'doc', 'docx', 'zip', 'rar', 'exe', 'html', 'php' file.";
      }
  
      if ($fileSize > 136314880) // 130M sur OVH 8M sur apache
      {
        $errors[] = "Le fichier dépasse la taille maximale autorisée (130Mo)";
      }
      if ($case == "Cloud" && (($this->TailleDossier($uploadDirectory) + $fileSize) > 2147483648))
      {
        $errors[] = "Votre espace va dépasser 2 Go.";
      }
      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
  
        if ($didUpload) {
          $msg .= "Le fichier " . basename($fileName) . " a été importé sur le serveur.";
        } else {
          $msg .= "Il y a eu une erreur. Contacter l'admin.";
        }
      } else {
        foreach ($errors as $error) {
          $msg .= $error . "\n";
        }
      }
    }  
    $this->write_logs($_SESSION['mail']." a tenté d\'uploader sur le serveur le fichier ".$fileName);
    return $msg;
  }

  public function TailleDossier($uploadDirectory)
  {
    $taille = 0;
    $fileList = glob(substr(($uploadDirectory."*.*"),1));
    foreach($fileList as $fileName)
    {
        $taille = $taille + filesize($fileName); 
      
    } 
    return $taille;
  }

  public function supprimer_fichier($file)
  {
    if ($_SESSION['role'] != 3)
    {
      $access = false;
      $who = $_SESSION['nom'].$_SESSION['prenom'];
      $folder = substr($file,6,strlen($who));
      if ($who == $folder)
        $access = true;
    }
    else
      $access=true;
    if ($access)
    {
      if(unlink($file))
      $this->write_logs($_SESSION['mail']." a supprimé le fichier ".$file);
      return "Fichier supprimé du serveur.";
    }
    else
    {
      $this->write_logs($_SESSION['mail']." a tenté de supprimer le fichier ".$file);
      return "Erreur de permission.";
    }
    
  }

  public function getListeFile()
  {
    $res = array();
    $fileList = glob('Cours/*.*');
    sort($fileList, SORT_NATURAL | SORT_FLAG_CASE); // tri ordre alpha case insensitive
    foreach($fileList as $filename)
    {
      if(is_file($filename))
      {
        $cours=new cours(null,null,$filename, null, null, null, null, null, null);
        $res[] = $cours; 
      }
    } 
    return $res;
  }

  public function getListeDepot()
  {
    $res = array();
    $fileList = glob('Depot/*.*');
    sort($fileList, SORT_NATURAL | SORT_FLAG_CASE); // tri ordre alpha case insensitive
    foreach($fileList as $filename)
    {
      if(is_file($filename))
      {
        $cours=new cours(null,null,$filename, null, null, null, null, null, null);
        $res[] = $cours; 
      }
    } 
    return $res;
  }

  public function getIDmax() 
  {
    $this->connexion();
    $reqCount = "select max(id_cours) as nb from cours;";
    $resCount = mysqli_query($this->GetCnx(), $reqCount);
    $ligne = mysqli_fetch_assoc($resCount);
    $id = $ligne['nb'];
    $id++;
    return $id;
  }

}
?>