<?php
	require_once(HelperPath.DS.'Database.php');

	class UserModel extends Database{
		
		//private  static $userId = "userId";
		private static $username = 'username';
	    private static $password = 'password';
		private static $autologin = "autologin";

		// UNCOMMENTED FAKE AUTHENTICATION DATA
			public function __construct () {
				$this->tabel = "user";
			}
/*
		public function AuthenticateUser($username , $password){

			var_dump($username);
			var_dump($password);
			try{
				
				$pdo = $this->connectionToDataBase();

				$sql = "SELECT * from $this->tabel 
				WHERE username = ?
				AND password = ?";

				$params = array($username, $password);
				$query = $pdo->prepare($sql);
				$query->execute($params);
				$result = $query->fetch();

				return $result ? true : false;

			}catch(PDOException $ex){

				die('An unknown error hase happened');
			}
		}
*/

		public function addNewUser(User $user){
			try{

				$pdo = $this->connectionToDataBase();

				$sql = "INSERT INTO $this->tabel    
				(" . self::$username . ", " . self::$password . ")
				VALUES(?,?)";

				$params = array($user->getUsername(), $user->getPasswrod());

				$query = $pdo->prepare($sql);

				$query->execute($params);

			}catch(PDOException $ex){

				die('An unknown error has happened jebla');
			}

		}

		public function AuthenticateUser($username) {
			
			try{

				$pdo = $this->connectionToDataBase();
				
				$sql = "SELECT * from $this->tabel 
				WHERE "  . self::$username . " =?";
				
				$params = array($username);

				$query = $pdo->prepare($sql);

				$query->execute($params);

				$result = $query->fetch();

				return $result ? true : false;
			
			}catch(PDOException $ex){

				die('An unknown error has happened');
			}
		}	

		public function userEX($username){
			try {

					$pdo = $this->connectionToDataBase();
			$sql ="SELECT COUNT(*) AS count 
			FROM $this->tabel  WHERE username=?";
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
		//	var_dump($timestamp);
		//	var_dump($username);
			try{
			//$result = mysql_query("CALL SaveCookieTimestamp('{$timestamp}', '{$userId}')");
			$newData = new UserModel();			
			$pdo = $newData->connectionToDataBase();


			$sql = "UPDATE $this->tabel
			SET  autologin  = ?
			WHERE  username = ?";
			$params = array($timestamp, $username);
			//var_dump($sql);
			$query = $pdo->prepare($sql);
			//var_dump($query);

			$query->execute($params);
			//echo "string";

		}
		catch(PDOException $ex){
		//	die('An unknown error has happened');
		}
			//$result = $query->fetch();

	
		//	return $result;
		}

		// get(username) 

		public function GetCookieDateById ($username) {
		try
		{
			$pdo = $this->connectionToDataBase();
			$sql = "SELECT autologin
			FROM $this->tabel
			 WHERE    username =?";
				
				$params = array($username);

				$query = $pdo->prepare($sql);

				$query->execute($params);

				$result = $query->fetchAll();

				$timestamp = array_shift($result);	
			
			//var_dump($timestamp);
			return $timestamp;

		}
		catch(PDOException $ex){
		//	die('An unknown error has happened');
		}
			//	var_dump($result); die();
			
		//	$timestamp = array_shift($result);
		//	var_dump($timestamp);
		//	return $timestamp;
		}

		public function UserCredentialManipulated ($username, $data) {

			$u = 'Admin';
			$p = 'Password';
			$hp = hash("sha256", $p);

			return ($u === $username && $hp === $data);
		}
	}

