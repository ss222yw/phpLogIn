<?php
	require_once(HelperPath.DS.'Database.php');

	class UserModel extends Database{
		
		private $userId;
		private $username ="username";
	    private $password = "password";
	    private $usernamee;
		private $firstname;
		private $surname;
		private $autologin;
		private $pdo;

		// UNCOMMENTED FAKE AUTHENTICATION DATA
			public function __construct () {

				$this->tabel = "user";
				$this->pdo = $this->connectionToDataBase();

			}

		public function GetUserId () {

			return $this->userId;
		}

		public function GetUsername () {

			return $this->username;
		}

		public function AuthenticateUser ($username, $password) {
			
			try{
				
				$sql = "SELECT * from $this->tabel
				WHERE username = ?
				AND password = ?";
			
				$query = $this->pdo->prepare($sql);

				$params = array($username, $password);

				$query->execute($params);

				$result = $query->fetchAll();

				return $result ? true : false;

			}catch(PDOException $ex){

				die('An unknown erro hase happend');
			}
		}	

	


		public function SaveCookieTimestamp ($timestamp, $userId) {

			global $database;

			$result = mysql_query("CALL SaveCookieTimestamp('{$timestamp}', '{$userId}')");

			 $result = $database->ExecuteSqlQuery($query);
			 mysql_affected_rows($result); die();
			 return mysql_num_rows($result) ? true : false;
		}

		public function GetCookieDateById () {

			global $database;

			$query = "SELECT autologin 
			FROM user
			WHERE userId = 1";
			
			$result = $database->ExecuteSqlQuery($query);

			$resultArr = mysql_fetch_row($result);
			$timestamp = array_shift($resultArr);

			return $timestamp;
		}

		public function UserCredentialManipulated ($username, $data) {

			$u = 'Admin';
			$p = 'Password';
			$hp = hash("sha256", $p);

			return ($u === $username && $hp === $data);
		}
	}

