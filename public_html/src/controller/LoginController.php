<?php
	require_once(HelperPath.DS.'SessionModel.php');
	require_once(ModelPath.DS.'UserModel.php');
	require_once(HelperPath.DS.'HTMLView.php');
	require_once(ViewPath.DS.'LoginView.php');
	require_once(ViewPath.DS.'MemberView.php');

	class LoginController {
		// REMINDER: WHEN CREATING MODELS, THE MODEL MIGHT HAVE TO INHERIT FROM THE DATABASE OBJECTS IN THE HELPERS FOLDER?

		private $loginView;
		private $memberView;
		private $userModel;
		private $sessionModel;

		function __construct () {

			$this->sessionModel = new SessionModel();
			$this->mainView = new HTMLView();
			$this->loginView = new LoginView();
			$this->memberView = new MemberView();
			$this->userModel = new UserModel();
		}

		public function RunLoginLogic () {

			// Initial setup of local variables.
			// Retrieve needed HTML for the views.
			$loginHTML = $this->loginView->GetLoginFormHTML();
			$memberHTML = $this->memberView->GetMemberStartHTML();

			// Set user authenticated flag
			$userAuthenticated = false;

			// Assign needed instances in local variables.
			$loginView = clone $this->loginView;		
			$memberView = clone $this->memberView;
			$sessionModel = clone $this->sessionModel;


			// RENDER START PAGE, Render loginView if user is not already logged in and did not press Login Button
			if(!$sessionModel->IsLoggedIn() && !$loginView->UserPressLoginButton()) {

				echo $this->mainView->echoHTML($loginHTML);
			}

			// USER LOGS OUT
			if ($memberView->UserPressLogoutButton()) {
				
				$this->sessionModel->LogoutUser();
			}

			// USER MAKES A LOGIN REQUEST
			if ($loginView->UserPressLoginButton()) {
				
				$userAuthenticated = $this->AuthenticateUser();

				// If comparison to database succeeded login user
				if ($userAuthenticated) {
					
					echo $this->mainView->echoHTML($memberHTML);
					return true;
				}
				else {

					var_dump("Error!");
				}
			}

			// USER IS ALREADY LOGGED IN AND RELOADS PAGE.
			if ($sessionModel->IsLoggedIn()) {
				
				echo $this->mainView->echoHTML($memberHTML);
				return true;
			}			
		}

		// HELPER FUNCTIONS FOR THIS CONTROLLER

		// Authentication logic. 
		protected function AuthenticateUser () {

			$username = $this->loginView->GetUsername();
			$password = $this->loginView->GetPassword();

			$userAuthenticated = $this->userModel->AuthenticateUser($username, $password);
			
			if ($userAuthenticated || $this->sessionModel->IsLoggedIn()) {

				$this->sessionModel->LoginUser($this->userModel);
				return $userAuthenticated;
			}
		}
	}