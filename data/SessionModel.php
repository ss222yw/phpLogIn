<?php
	class SessionModel {

		private $isLoggedIn = false;
		private $userId;
		private $message;

		function __construct () {

			session_start();
		}

		public function IsLoggedIn () {

			return $this->isLoggedIn;
		}

		public function LoginUser ($user) {

			// $this->userId = $_SESSION["userId"] = $user->GetUserId();
			$this->isLoggedIn = true;
		}

		public function SetValidSession () {

			$_SESSION['valid'] = true;
		}

		public function SetUserId ($user) {

			$_SESSION['userId'] = $user->GetUserId();
		}

		public function GetUserId () {

			if (isset($_SESSION['userId'])) {
				
				return $_SESSION['userId'];
			}
			else {

				return false;
			}
		}

		public function IsValidSession () {

			if (isset($_SESSION['valid'])) {
				
				return $_SESSION['valid'];
			} else {

				return false;
			}
		}

		public function LogoutUser () {

			unset($_SESSION['valid']);
			// unset($this->userId);
			$this->isLoggedIn = false;
		}
	}