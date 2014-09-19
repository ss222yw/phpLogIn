<?php
	require_once(HelperPath.DS.'Database.php');

	class UserModel {

		protected static $tableName = "user";
		
		private $userId;
		private $username;
		private $password;
		private $firstname;
		private $surname;
		private $autologin;

		// UNCOMMENTED FAKE AUTHENTICATION DATA
		// public function __construct () {

		// 	$this->username = "Shari";
		// 	$this->password = "test";
		// }
		public function GetUserId () {

			return $this->userId;
		}

		public function AuthenticateUser ($username, $password) {

			global $database;

			// $result = mysql_query("CALL AuthenticateUser('{$username}', '{$password}')");

			// $database->StoreResult();

			$query = "SELECT * from user
			WHERE username = '{$username}'
			AND password = '{$password}'";
			
			$result = $database->ExecuteSqlQuery($query);

			// MAYBE MOVE THIS CODE TO A COMMON DATABASE CLASS INHERITED BY THIS CLASS.
			if (mysql_num_rows($result) === 1) {
				
				while ($row = mysql_fetch_assoc($result)) {

					// $userObject = new self;
					$this->userId = $row['userId'];
					$this->username = $row['username'];
					$this->password = $row['password'];
					$this->firstname = $row['firstname'];
					$this->surname = $row['surname'];
				}

				return true;
			}
			else {

				return false;
			}
		}

		public function SaveCookieTimestamp ($timestamp, $userId) {

			global $database;

			$result = mysql_query("CALL SaveCookieTimestamp('{$timestamp}', '{$userId}')");

			// $result = $database->ExecuteSqlQuery($query);
			// mysql_affected_rows($result); die();
			// return mysql_num_rows($result) ? true : false;
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


