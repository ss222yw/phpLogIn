<?php
	require_once(HelperPath.DS.'SessionModel.php');
	require_once(ViewPath.DS.'MemberView.php');

	class LoginController {
		// REMINDER: WHEN CREATING MODELS, THE MODEL MIGHT HAVE TO INHERIT FROM THE DATABASE OBJECTS IN THE HELPERS FOLDER?

		private $loginView;
		private $memberView;
		private $userModel;
		private $sessionModel;

		function __construct () {

			// echo 'LoginView is instantiated and stored in a member of this controller class.';
			$this->sessionModel = new SessionModel();
			$this->loginView = new LoginView();
			$this->memberView = new MemberView();
			$this->userModel = new UserModel();
		}

		public function GetLoginFormHTML () {

			$loginHTML = $this->loginView->GetLoginFormHTML();
			return $loginHTML;
			// var_dump($loginHTML);
		}

		public function GetMemberStartHTML() {

			$memberHTML = $this->memberView->GetMemberStartHTML();
			return $memberHTML;
		}

		public function IsLoggedIn() {

			return $this->sessionModel->IsLoggedIn();
		}

		public function UserPressLoginButton () {

			return $this->loginView->UserPressLoginButton();
		}

		public function UserPressLogoutButton () {

			return $this->memberView->UserPressLogoutButton();
		}

		public function LogoutUser () {
				
			$this->sessionModel->LogoutUser();
		}

		public function AuthenticateUser () {

			$username = $this->loginView->GetUsername();
			$password = $this->loginView->GetPassword();

			$userAuthenticated = $this->userModel->AuthenticateUser($username, $password);
			
			if ($userAuthenticated || $this->sessionModel->IsLoggedIn()) {

				$this->sessionModel->LoginUser($this->userModel);
				return $userAuthenticated;
			}
		}
	}