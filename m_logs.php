<?php
require_once "Classes/logs.php";
require_once "m_database.php";
class m_logs extends m_database
{
  public function getAllLogs()
  {
    $liste = array();
    $this->connexion();
    $req="select * from logs ORDER BY `logs`.`id` DESC;";
    $res=mysqli_query($this->GetCnx(), $req);
    $ligne = mysqli_fetch_assoc($res);
    while($ligne) //
    {
      $logs=new logs($ligne["id"],$ligne["log_contenu"]);
      $liste[]=$logs;
      $ligne = mysqli_fetch_assoc($res);
    }
    $this->deconnexion();
    return $liste;
  }
}
?>