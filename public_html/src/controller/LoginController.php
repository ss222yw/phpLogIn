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
			$this->loginView = new LoginView();
			$this->memberView = new MemberView();
			$this->userModel = new UserModel();
			$this->sessionModel = new SessionModel();
		}

		public function DisplayLogin () {

			$loginHTML = $this->loginView->ShowLoginForm();
			return $loginHTML;
			// var_dump($loginHTML);
		}

		public function DisplayMemberView() {

			$memberHTML = $this->memberView->ShowMemberView();
			return $memberHTML;
		}

		public function IsLoggedIn() {

			return $this->sessionModel->IsLoggedIn();
		}

		public function UserPressLoginButton () {

			return $this->loginView->UserPressLoginButton();
		}

		public function UserPresssLogoutButton () {

			// return $this->memberView->UserPressLogoutButton();
			if ($this->memberView->UserPressLogoutButton()) {
				
				$this->sessionModel->LogoutUser();
			}
		}

		public function IsValidSession () {

			return $this->sessionModel->IsValidSession();
		}

		public function AuthenticateUser () {

			$username = $this->loginView->GetUsername();
			$password = $this->loginView->GetPassword();

			if (!$this->IsLoggedIn()) {

				$user = $this->userModel->AuthenticateUser($username, $password);

				if ($user) {
					
					$this->sessionModel->SetValidSession();
					$this->sessionModel->SetUserId($user);
					$sessiontest = $this->sessionModel->GetUserId();
				}
				
				if ($user || $this->sessionModel->IsValidSession()) {

					// TODO: Login user with session.
					$this->sessionModel->LoginUser($user);
					return $this->DisplayMemberView();
				}
			}

			return "";
		}
	}