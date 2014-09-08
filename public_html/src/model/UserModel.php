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

		public function AuthenticateUser ($username, $password) {

			global $database;

			// String Dependency!!
			$sql = "SELECT * FROM user ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "AND password = '{$password}'";

			// TODO: Implement $database->AuthenticateUser(); as a SPROC
			$result = $database->ExecuteSqlQuery($sql);

			while ($row = mysql_fetch_assoc($result)) {

				$this->username = $row['username'];
				$this->password = $row['password'];
			}

			return $username === $this->username
				&& $password === $this->password;
		}
	}


