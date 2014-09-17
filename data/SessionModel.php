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

			global $remote_ip;
			// global $b_ip;
			global $user_agent;

			// session_set_cookie_params(0);
			$this->userId = $_SESSION["userId"] = $user->GetUserId();
			$_SESSION["unique"] = hash("sha256", $remote_ip . $user_agent);
			$this->isLoggedIn = true;
		}

		public function LogoutUser () {

			unset($_SESSION['userId']);
			$this->isLoggedIn = false;
		}
	}