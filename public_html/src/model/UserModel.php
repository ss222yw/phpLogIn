<?php
	require_once(HelperPath.DS.'Database.php');

	class UserModel {

		protected static $tableName = "user";
		// protected static $dbFields = array('userId', 'username', 'password', 'firstname', 'surname');
		private $userId;
		private $username;
		private $password;
		private $firstname;
		private $surname;

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

			// String Dependency!!
			$sql = "SELECT * FROM user ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "AND password = '{$password}'";

			// TODO: Implement $database->AuthenticateUser(); as a SPROC
			$result = $database->ExecuteSqlQuery($sql);

			// MAYBE MOVE THIS CODE TO A COMMON DATABASE CLASS INHERITED BY THIS CLASS.
			while ($row = mysql_fetch_assoc($result)) {

				$userObject = new self;
				$userObject->id = $row['userId'];
				$userObject->username = $row['username'];
				$userObject->password = $row['password'];
				$userObject->firstname = $row['firstname'];
				$userObject->surname = $row['surname'];
			}

			return !empty($userObject) ? $userObject : false;
		}
	}


