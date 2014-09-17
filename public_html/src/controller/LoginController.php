<?php
	require_once(HelperPath.DS.'SessionModel.php');
	require_once(ModelPath.DS.'Validator.php');
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
		private $validator;

		function __construct () {

			$this->sessionModel = new SessionModel();
			$this->mainView = new HTMLView();
			$this->loginView = new LoginView();
			$this->memberView = new MemberView();
			$this->userModel = new UserModel();
		}

		public function RunLoginLogic () {

			global $remote_ip;
			global $b_ip;
			global $user_agent;
			// Set user authenticated flag
			$userAuthenticated = false;

			// Assign needed instances in local variables.
			$loginView = clone $this->loginView;		
			$memberView = clone $this->memberView;
			$sessionModel = clone $this->sessionModel;

			// Initial setup of local variables.
			// Retrieve needed HTML for the views.
			$loginHTML = $this->loginView->GetLoginFormHTML();
			$memberHTML = $this->memberView->GetMemberStartHTML("Inloggning lyckades.");

			// RENDER START PAGE, Render loginView if user is not already logged in and did not press Login Button
			if(!$sessionModel->IsLoggedIn() && !$loginView->UserPressLoginButton() && !isset($_COOKIE['username'])) {

				// Generate output data
				echo $this->mainView->echoHTML($loginHTML);
				return;
			}

			// USER LOGS OUT
			if ($memberView->UserPressLogoutButton()) {
				
				$this->LogoutUser();
				return true;
			}

			// USER MAKES A LOGIN REQUEST
			if ($loginView->UserPressLoginButton()) {
				
				$result = $this->AuthenticateUser();

				// If comparison to database succeeded login user
				if ($result === true) {
					
					// Set special successmessage IF user wants to be remembered.
					// TODO: MOVE THIS IF STATIEMENT OUTSIDE AND ABOVE THE RESULT CHECK
					if ($loginView->AutoLoginIsChecked()) {

						$memberHTML = $this->memberView->GetMemberStartHTML("Inloggning lyckades och vi kommer ihåg dig nästa gång");
					}

					// Render memberView.
					echo $this->mainView->echoHTML($memberHTML);					
					return true;
				}
				else {

					// Set error messages if authentication failed.
					$loginHTML = $this->loginView->GetLoginFormHTML($result);
					echo $this->mainView->echoHTML($loginHTML);
				}
			}

			// USER IS ALREADY LOGGED IN AND RELOADS PAGE or USER LOGGED IN WITH REMEMBER ME AND RELOADS
			if ($sessionModel->IsLoggedIn() || isset($_COOKIE['username'])) {

				$validId = hash("sha256", $remote_ip . $user_agent);

				if ($validId != $_SESSION['unique']) {
					
					$this->LogoutUser();
					return true;
				}

				// Check if somebody manipulated cookies.
				if ( ($this->UserCredentialManipulated() || $this->CookieDateManipulated()) && isset($_COOKIE['username']) ) {

					$this->LogoutUser('Fel information i cookie.');
					return true;
				}

				// Generate output data
				if ($sessionModel->IsLoggedIn()) {
					
					$memberHTML = $this->memberView->GetMemberStartHTML('');
				}
				else {

					$memberHTML = $this->memberView->GetMemberStartHTML('Inloggning lyckades via cookies.');
				}
				
				echo $this->mainView->echoHTML($memberHTML);

				return true;
			}
		}

		// HELPER FUNCTIONS FOR THIS CONTROLLER

		// Authentication logic. 
		protected function AuthenticateUser () {

			$username = $this->loginView->GetUsername();
			$password = $this->loginView->GetPassword();

			// 1. CLIENT-WORK: VALIDATE IN-DATA 
			$message = $this->loginView->Validate();


			if ($message !== true) {
				
				return $message;
			}

			// 2. SERVER-AUTHENTICATION: CHECK WITH DATABASE IF USERNAME AND PASSWORD EXIST
			$userAuthenticated = $this->userModel->AuthenticateUser($username, $password);
			
			if ($userAuthenticated) {

				// TODO: Check that this is not done more than once.
				$this->sessionModel->LoginUser($this->userModel);

				if ($this->loginView->AutoLoginIsChecked()) {

					// TODO: Change 30 to a constant/variable.
					$cookieTimestamp = time() + 30;
					$this->loginView->SaveUserCredentials($username, $password, $cookieTimestamp);
					$this->userModel->SaveCookieTimestamp($cookieTimestamp, $this->sessionModel->GetuserId());
				}

				return $userAuthenticated;
			}
			else {

				return $this->loginView->GetLoginErrorMessage();
			}
		}

		protected function UserCredentialManipulated () {

			// TODO: Get the cookie values from the view before sending them to AuthenticateUser.
			return !@$this->userModel->AuthenticateUser($_COOKIE['username'], $_COOKIE['password']);
		}

		protected function CookieDateManipulated () {

			$currentTime = time();
			$cookieExpTime = (int)($this->userModel->GetCookieDateById());

			return ($currentTime > $cookieExpTime) ? true : false;
		}

		protected function LogOutUser ($successMessage = 'Du är nu utloggad.') {

				// Remove cookies if remember me. 
				if (isset($_COOKIE['username'])) {
					
					$this->loginView->DeleteUserCredentials();
				}

				// Logout user and render loginView.
				$this->sessionModel->LogoutUser();
				$loginHTML = $this->loginView->GetLoginFormHTML($successMessage);
				echo $this->mainView->echoHTML($loginHTML);	
		}
	}