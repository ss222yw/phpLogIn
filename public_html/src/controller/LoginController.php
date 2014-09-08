<?php
	class LoginController {

		// REMINDER: WHEN CREATING MODELS, THE MODEL MIGHT HAVE TO INHERIT FROM THE DATABASE OBJECTS IN THE HELPERS FOLDER?

		private $loginView;
		private $userModel;

		function __construct () {

			// echo 'LoginView is instantiated and stored in a member of this controller class.';
			$this->loginView = new LoginView();
			$this->userModel = new UserModel();
		}

		public function DisplayLogin () {

			$loginHTML = $this->loginView->ShowLoginForm();
			return $loginHTML;
			// var_dump($loginHTML);
		}

		public function UserLogin () {

			return $this->loginView->UserLogin();
		}

		public function AuthenticateUser () {

			$username = $this->loginView->GetUsername();
			$password = $this->loginView->GetPassword();

			if ($this->userModel->AuthenticateUser($username, $password) !== false) {

				// TODO: Login user with session.
				echo "Welcome $username!";
			}
		}
	}