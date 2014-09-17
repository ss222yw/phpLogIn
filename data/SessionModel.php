<?php
	class SessionModel {

		private $isLoggedIn = false;
		private $userId;
		private $message;

		function __construct () {

			if (!isset($_SESSION['LoginValues'])) {
				
				$_SESSION['LoginValues']['username'] = '';
			}
		}

		public function IsLoggedIn () {

			// return $this->isLoggedIn;
			return isset($_SESSION['userId']);
		}

		public function GetUserId () {

			return $this->userId;
		}

		public function LoginUser (UserModel $user) {

			// session_set_cookie_params(0);
			$this->userId = $_SESSION["userId"] = $user->GetUserId();
			$this->isLoggedIn = true;
		}

		public function LogoutUser () {

			unset($_SESSION['userId']);
			$this->isLoggedIn = false;
		}
	}