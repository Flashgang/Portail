<?php
require_once "Classes/news.php";
require_once "m_database.php";
class m_news extends m_database
{
  public function getAll()
  {
    $liste = array();
    $this->connexion();
    $req="select * from news ORDER BY `news`.`news_id` DESC LIMIT 7;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne) //
    {
      $news=new news($ligne["news_id"],$ligne["contenu"]);
      $liste[]=$news;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }

  
  public function maj_news($nouvelle)
  {
    $this->connexion();
    $nouvelle=mysqli_real_escape_string($this->GetCnx(),$nouvelle);
    $req="insert into news VALUES ('','$nouvelle');";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    $this->write_logs($_SESSION['mail']." a tenté d\'ajouter la news ".$nouvelle);
  }

  public function supprimer_news($id)
  {
    $this->connexion();
    $req="delete from news where news_id = $id;";
    mysqli_query($this->GetCnx(), $req);
    $this->deconnexion();
    $this->write_logs($_SESSION['mail']." a tenté de supprimer la news ".$id);
  }

}