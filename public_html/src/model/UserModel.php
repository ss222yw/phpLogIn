<?php

	class UserModel {

		protected static $tableName = "user";
		// protected static $dbFields = array('userId', 'username', 'password', 'firstname', 'surname');
		private $userId;
		private $username;
		private $password;
		private $firstname;
		private $surname;

		public function __construct () {

			$this->username = "Shari";
			$this->password = "test";
		}

		public function AuthenticateUser ($username, $password) {

			echo "Checking if $username and $password is correct.";
			return $username === $this->username
				&& $password === $this->password;
		}
	}


