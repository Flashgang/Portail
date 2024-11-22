<?php
require_once "Classes/user.php";
require_once "m_database.php";
class m_user extends m_database
{
    public function inscription($nom, $prenom, $classe, $mail, $mdp)
    {
      $user=null;
      $this->connexion();
      $mail=mysqli_real_escape_string($this->GetCnx(),$mail);
      $nom=mysqli_real_escape_string($this->GetCnx(),$nom);
      $prenom=mysqli_real_escape_string($this->GetCnx(),$prenom);
      $mdp=mysqli_real_escape_string($this->GetCnx(),$mdp);
      $mdp = password_hash($mdp, PASSWORD_DEFAULT);
      $req = "insert into users values ('".$mail."','".$nom."','".$prenom."','".$mdp."','','".$classe."', '');";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
			{
				$user=new user($nom, $prenom, $mail, $classe, $mdp, 0, 0);
        $message = "Bonjour, \nVotre inscription au portail SIO a bien été prise en compte.\nVous recevrez un mail lorsque cette dernière aura été traitée.\n\nBien à vous\n\nN.Dupont";
        $this->mail_user($user->getMail(), $message, 'Votre compte sur le Portail SIO');
        $message = "Une nouvelle personne s'est inscrite sur le portail SIO, compte à valider.\n".$mail."\n".$nom."\n".$prenom."\n".$classe;
        $this->mail_user("admin@portail-sio.fr", $message, "Nouvelle inscription");
			}
			$this->deconnexion();
      //creation du dossier cloud
      mkdir("Cloud/".$nom.$prenom);
      $this->write_logs($mail." s\'est inscrit sur le portail.");
			return $user;
    }

    public function mail_user($mail, $message, $subject)
    {
      $headers = 'From: admin@portail-sio.fr' . "\r\n" .
          'Reply-To: admin@portail-sio.fr' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      mail($mail, $subject, $message, $headers);
    }

    public function verification($mail)
    {
      // fonction renvoyant 1 si le mail est dispo, 0 si le mail est déjà en base
      $verif = 1;
      $this->connexion();
      $mail=mysqli_real_escape_string($this->GetCnx(),$mail); // faire pour tous les champs
      $req="select * from users where mail = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if(mysqli_num_rows ( $res ) != 0)
        $verif=0;
      return $verif;
    }

    public function connexion_user($mail, $mdp)
    {
      $user=null;
      $this->connexion();
      $mail=mysqli_real_escape_string($this->GetCnx(),$mail);
      $mdp=mysqli_real_escape_string($this->GetCnx(),$mdp);
      $req="select * from users where mail = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if (mysqli_num_rows ( $res ) == 1)
			{
        $ligne = mysqli_fetch_assoc($res);
        if(password_verify($mdp, $ligne['mdp']))
        {
          if($ligne["statut"] == 1) // user actif
          {
            $user=new user($ligne["nom"],$ligne["prenom"],$ligne["mail"],$ligne["user_role"],$ligne["mdp"],$ligne["statut"],$ligne["last_cnx"]);
            clearstatcache();
		$this->session_user($ligne["mail"]);
            $this->set_cnx_time($ligne["mail"]);
          }
          else
            $user="inactif";
        }
        else
          $user="password";
			}
			$this->deconnexion();
      $this->write_logs($mail." a tenté de se connecter.");
			return $user;
    }

    public function deconnexion_user()
    {
      $this->write_logs($_SESSION['mail']." s\'est déconnecté ");
      session_unset();
      session_destroy();
    }
    private function set_cnx_time($mail)
    {
      $today = date("d-m-Y H:i:s");
      $req="update `users` SET `last_cnx` = '".$today."' WHERE `users`.`mail` = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
    }
    private function session_user($mail)
    {
      $req="select * from users where mail = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      $ligne = mysqli_fetch_assoc($res);
      $_SESSION["nom"] = $ligne["nom"];
      $_SESSION["prenom"] = $ligne["prenom"];
      $_SESSION["mail"] = $ligne["mail"];
      $_SESSION["role"] = $ligne["user_role"];
    }

    public function getListe()
    {
      $liste = array();
      $this->connexion();
      $req="select * from users order by Statut, nom, prenom;";
      $res=mysqli_query($this->GetCnx(), $req);
      $ligne = mysqli_fetch_assoc($res);
      while($ligne) // user actif
      {
        $user=new user($ligne["nom"],$ligne["prenom"],$ligne["mail"],$ligne["user_role"],$ligne["mdp"],$ligne["statut"],$ligne["last_cnx"]);
        $liste[] = $user;
        $ligne = mysqli_fetch_assoc($res);
      }
			$this->deconnexion();
			return $liste;
    }

    public function getListeDetails()
    {
      $liste = array();
      $this->connexion();
      $req="select nom, prenom, mail, role_lib, mdp, statut, last_cnx FROM users JOIN role ON users.user_role = role.role_id ORDER BY statut, role_lib DESC, nom, prenom;";
      $res=mysqli_query($this->GetCnx(), $req);
      $ligne = mysqli_fetch_assoc($res);
      while($ligne) // user actif
      {
        $user=new user($ligne["nom"],$ligne["prenom"],$ligne["mail"],$ligne["role_lib"],$ligne["mdp"],$ligne["statut"], $ligne["last_cnx"]);
        $liste[] = $user;
        $ligne = mysqli_fetch_assoc($res);
      }
			$this->deconnexion();
			return $liste;
    }

    public function getInfos($mail)
    {
      $user = null;
      $this->connexion();
      $req="select * from users where mail = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      $ligne = mysqli_fetch_assoc($res);
      if($ligne) // user actif
      {
        $user=new user($ligne["nom"],$ligne["prenom"],$ligne["mail"],$ligne["user_role"],$ligne["mdp"],$ligne["statut"], $ligne["last_cnx"]);
      }
			$this->deconnexion();
			return $user;
    }

    public function valider($mail)
    {
      $ok = 0;
      $this->connexion();
      $req="update `users` SET `statut` = '1' WHERE `users`.`mail` = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
			{
				$ok = 1;
        $message = "Bonjour, \nVotre inscription au portail SIO a été validée.\nVous pouvez donc vous connecter dès à présent.\n\nBien à vous\n\nN.Dupont";
        $this->mail_user($mail, $message, "Validation d'inscription");
			}
			$this->deconnexion();
      $this->write_logs($mail." a été validé par ".$_SESSION['mail']);
			return $ok;
    }

    public function desactiver($mail)
    {
      $ok = 0;
      $this->connexion();
      $req="update `users` SET `statut` = '0' WHERE `users`.`mail` = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
			{
				$ok = 1;
        $message = "Bonjour, \nVotre compte du portail SIO a été désactivé.\nS'il s'agit d'une erreur, vous pouvez le signaler par retour de mail.\n\nBien à vous\n\nN.Dupont";
        $this->mail_user($mail, $message, "Désactivation de compte");
			}
			$this->deconnexion();
      $this->write_logs($_SESSION['mail']." a desactivé le mail nommé ".$mail);
			return $ok;
    }

    public function modification($nom, $prenom, $mail, $classe)
    {
      $ok = 0;
      $this->connexion();
      $req="update `users` SET `nom` = '".$nom."', `prenom` = '".$prenom."', `mail` = '".$mail."', `user_role` = ".$classe." WHERE `users`.`mail` = '".$_SESSION['mail_av_modif']."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
			{
				$ok = 1;
			}
      if ($_SESSION['role'] != 3) // quand on est admin, l'update sur soi meme n'est pris en compte qu'à la prochaine connexion
        $this->session_user($mail);
			$this->deconnexion();
      $this->write_logs($_SESSION['mail']." a modifié les données du compte de ".$nom. " ".$prenom);
			return $ok;
    }

    public function supprimer($mail)
    {
      $user = $this->getInfos($mail);
      $pathCloud = "Cloud/".$user->getNom().$user->GetPrenom();
      $ok = "Erreur lors de la suppression.";
      $this->connexion();
      $req="delete from users WHERE `users`.`mail` = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
			{
				$ok = "Le compte a été supprimé.";
        //suppression du dossier cloud
        $this->supprimer_cloud($pathCloud);
			}
			$this->deconnexion();
      $this->write_logs($_SESSION['mail']." a supprimé le compte de ".$mail);
			return $ok;
    }

    public function supprimer_cloud($pathCloud)
    {
      $content = scandir($pathCloud);
      if(!empty($content))
      {
        $files = glob($pathCloud.'/*'); 
        foreach($files as $file) {   
          if(is_file($file)) 
              unlink($file); 
        }
      }
      rmdir($pathCloud);
      $this->write_logs($_SESSION['mail']." a supprimé le cloud de ".$pathCloud);
    }

    public function passage()
    {
      $this->connexion();
      $req="update users SET statut = 0 where user_role = 2;";
      mysqli_query($this->GetCnx(), $req);
      $req="update users SET user_role = 2 WHERE user_role = 1;";
      mysqli_query($this->GetCnx(), $req);
      $this->deconnexion();
      $this->write_logs($_SESSION['mail']." a affectué un passage d\'année");
    }

    public function contact_send($mail, $text)
    {
      $this->send_mail($mail, $text);
      return "Mail envoyé.";
    }

    public function modif_password($mail, $mdp)
    {
      $ok = "Erreur lors de la modification.";
      $mdp = password_hash($mdp, PASSWORD_DEFAULT);
      $this->connexion();
      $req="update `users` SET `mdp` = '".$mdp."' WHERE `users`.`mail` = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if ($res != false)
				$ok = "Mot de passe modifié.";
			$this->deconnexion();
      $this->write_logs($mail." a modifié son mot de passe ");
			return $ok;
    }

    public function recovery_pwd($mail)
    {
      $this->connexion();
      $req="select * from users where mail = '".$mail."';";
      $res=mysqli_query($this->GetCnx(), $req);
      if(mysqli_num_rows($res) == 0) // user actif
        $msg = "L'email rentré n'existe pas en base.";
      else
      {
        $mdp = $this->generer_mdp_compte($mail);
        $msg = "Un mail vous a été envoyé à l'adresse indiquée.";
        $msg_mail = "Bonjour\n\nVous avez demandé une réinitialisation de votre mot de passe.\nVotre nouveau mot de passe est : ".$mdp."\nPensez à le modifier !\n\nBien à vous.\nN.Dupont";
        $this->mail_user($mail, $msg_mail, "Portail-SIO : Votre mot de passe");
      }
      $this->write_logs($mail." a demandé un renouvellement de mot de passe ");
      return $msg;
    }

    private function generer_mdp_compte($mail)
    {
      $mdp = "";
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $var_size = strlen($chars); 
      for( $x = 0; $x < 8; $x++ ) {  
        $mdp .= $chars[ rand( 0, $var_size - 1 ) ];  
      }
      $mdpH = password_hash($mdp, PASSWORD_DEFAULT);
      $this->connexion();
      $req="update `users` SET `mdp` = '".$mdpH."' WHERE `users`.`mail` = '".$mail."';";
      mysqli_query($this->GetCnx(), $req);
      $this->deconnexion();
      return $mdp;
    }

    public function generation_liste_mails()
    {
      $liste = null;
      $this->connexion();
      $req="select mail from users where (user_role = 1 or user_role = 2) and statut = 1 order by user_role;";
      $res=mysqli_query($this->GetCnx(), $req);
      $ligne = mysqli_fetch_assoc($res);
      while($ligne) 
      {
        $liste .= $ligne["mail"].';<br/>';
        $ligne = mysqli_fetch_assoc($res);
      }
			$this->deconnexion();
			return $liste;
    }

  public function getListeCloud()
  {
    $res = array();
    $patronyme = $_SESSION["nom"].$_SESSION["prenom"];
    $fileList = glob('Cloud/'.$patronyme.'/*.*');
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

  public function getListeCloudEleve($mail)
  {
    $res = array();
    $eleve = $this->getInfos($mail);
    $patronyme = $eleve->getNom().$eleve->getPrenom();
    $fileList = glob('Cloud/'.$patronyme.'/*.*');
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
}
?>
