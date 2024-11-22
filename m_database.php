<?php
	class m_database
	{
		private $cnx;
		public function GetCnx()
		{
			return $this->cnx;
		}
		public function connexion()
		{
			
			$this->cnx=mysqli_connect("localhost","root","","db_portail");
			mysqli_set_charset($this->cnx, "utf8");
		}
		public function deconnexion()
		{
			mysqli_close($this->cnx);
		}
		public function send_mail($mail, $text)
		{
			$to      = 'admin@portail-sio.fr';
			$subject = 'Message utilisateur';
			$headers = 'From: '.$mail.'' . "\r\n" .
						'Reply-To: '.$mail.'' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $text, $headers);
		}
		public function dl_alldepot()
		{	
			$folder = "/Depot";
			// Récupérez tous les fichiers dans le dossier
			$files = scandir(getcwd().$folder);
			print_r($files);
			echo $folder;
			// Créez un nom de fichier ZIP
			$zip_file = basename($folder) . ".zip";
			unlink(getcwd().$folder."/".$zip_file);
			// Créez un nouveau fichier ZIP
			$zip = new ZipArchive();
			$zip->open(getcwd().$folder.'/'.$zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
			
			// Ajoutez chaque fichier au fichier ZIP
			foreach ($files as $file) {
				if ($file === "." || $file === ".." || $file === ".htaccess" || $file === "depot.zip") continue;
				$zip->addFile(getcwd()."$folder/$file", $file);
			  }
			
			// Fermez le fichier ZIP
			$zip->close();			
			// Supprimez le fichier ZIP temporaire
			// Envoie le fichier ZIP au navigateur pour téléchargement
			header('Content-Type: application/zip');
			header("Content-Disposition: attachment; filename=$folder/$zip_file");
			header('Content-Length: ' . filesize(getcwd().$folder."/".$zip_file));
			header("Location: $folder/$zip_file");
		}
		public function write_logs($info)
		{
			setlocale(LC_TIME, "fr_FR.UTF-8");
			$dateSTR = strftime("%d %B %Y - %H:%M:%S");
			$moisAnglais = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$moisFrancais = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
			$dateSTR = str_replace($moisAnglais, $moisFrancais, $dateSTR);
			$this->connexion();
			$req="INSERT INTO logs values ('', '[$dateSTR] $info');";
			$res=mysqli_query($this->GetCnx(), $req);
			$this->deconnexion();
		}
		public function dl_alllogs()
		{
			$table = "logs";
			$this->connexion();
			$req = "SELECT * FROM $table";
			$res = mysqli_query($this->GetCnx(), $req);
			$this->deconnexion();
			$filename = "logs.zip";
			$zip = new ZipArchive();
		
			if ($zip->open($filename, ZipArchive::CREATE) === true) {
				$content = '';
		
				while ($row = $res->fetch_assoc()) {
					foreach ($row as $value) {
						$content .= $value . "\t";
					}
					$content .= "\n";
				}
		
				$zip->addFromString("logs.txt", $content);
				$zip->close();
		
				// Envoi du fichier téléchargé
				header('Content-Type: application/zip');
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header('Content-Length: ' . filesize($filename));
				readfile($filename);
		
				// Suppression du fichier
				unlink($filename);
			}
		}
	}
?>
