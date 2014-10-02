<?php
	require_once(HelperPath.DS.'Database.php');

	class UserModel extends Database {
		
		private static $username = 'username';
	    private static $password = 'password';
		private static $autologin = "autologin";

		// UNCOMMENTED FAKE AUTHENTICATION DATA
			public function __construct () {
				$this->tabel = "user";
			}

		public function AuthenticateUser($username) {

		
			try {
				
				$pdo = $this->connectionToDataBase();
				$sql = "SELECT * from $this->tabel 
				WHERE BINARY ". self::$username ." = ?";
				$params = array($username);
				$query = $pdo->prepare($sql);
				$query->execute($params);
				$result = $query->fetch();
				return $result;

			}catch(PDOException $ex) {

				die('An unknown error hase happened');
			}
		}


		public function addNewUser(User $user) {

			try {

				$pdo = $this->connectionToDataBase();

				$sql = "INSERT INTO $this->tabel    
				(" . self::$username . ", " . self::$password . ")
				VALUES(?,?)";

				$params = array($user->getUsername(), $user->getPasswrod());

				$query = $pdo->prepare($sql);

				$query->execute($params);

			}catch(PDOException $ex) {

				die('An unknown error has happened jebla');
			}

		}


		public function userEX($username) {
			try {

			$pdo = $this->connectionToDataBase();
			$sql ="SELECT COUNT(*) AS count 
			FROM $this->tabel  WHERE BINARY username=?";
			$params = array($username);
			$query = $pdo->prepare($sql);
			$query->execute($params);

			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  			$count = $row["count"];
			}
			if ($count > 0) {
  			return false;
			}
			return true;
				
			} catch (Exception $e) {

				
			die('An unknown error has happened');	
				
			}
		
		}		


		public function SaveCookieTimestamp ($timestamp, $username) {

			try {
			$newData = new UserModel();			
			$pdo = $newData->connectionToDataBase();
			$sql = "UPDATE $this->tabel
			SET  autologin  = ?
			WHERE  username = ?";
			$params = array($timestamp, $username);
			$query = $pdo->prepare($sql);
			$query->execute($params);

			}
			catch(PDOException $ex) {
				die('An unknown error has happened');
			}
	
		}


		public function GetCookieDateById ($username) {

		try {

			$pdo = $this->connectionToDataBase();
			$sql = "SELECT autologin
			FROM $this->tabel
			WHERE    username =?";
			$params = array($username);
			$query = $pdo->prepare($sql);
			$query->execute($params);
			$result = $query->fetchAll();
			$timestamp = array_shift($result);	
			return $timestamp;
			}
			catch(PDOException $ex){
				die('An unknown error has happened');
			}
			
		}

		public function UserCredentialManipulated ($username, $data) {

			$u = 'Admin';
			$p = 'Password';
			$hp = hash("sha256", $p);

			return ($u === $username && $hp === $data);
		}
	}

