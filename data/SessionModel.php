<?php
	class SessionModel {

		private $isLoggedIn = false;
		private $userId;
		private $message;

		function __construct () {

			// session_start();
		}

		public function IsLoggedIn () {

			// return $this->isLoggedIn;
			return isset($_SESSION['userId']);
		}

		public function LoginUser (UserModel $user) {

			$this->userId = $_SESSION["userId"] = $user->GetUserId();
			$this->isLoggedIn = true;
		}

		public function LogoutUser () {

			unset($_SESSION['userId']);
			// unset($this->userId);
			$this->isLoggedIn = false;
			header('Location: index.php');
		}
	}