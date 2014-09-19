<?php
	require_once(ViewPath.DS.'CookieStorage.php');

	class LoginView {

		private static $loginErrorMessage = "Felaktigt användarnamn och/eller lösenord.";
		private static $emptyUsernameErrorMessage = "Användarnamn saknas.";
		private static $emptyPasswordErrorMessage = "Lösenord saknas.";

		private $cookieStorage;

		function __construct() {

			$this->cookieStorage = new CookieStorage();
		}	

		public function GetLoginFormHTML ($message = '') {

			// IF cookie with errors is set render a sertain view.
			$responseMessages = '';

			if ($message != '') {
					
				$responseMessages .= '<p>' . $message . '</p>';
			}

			$loginHTML = 
			'<h2>Ej Inloggad</h2>' .

			'<form id="login" enctype="multipart/form-data" method="post" action="?login">' .
				'<fieldset>' .
					'<legend>Login - Skriv in användarnamn och lösenord</legend>' .
					$responseMessages .
					'<label for="username">Användarnamn : </label>' .
					'<input type="text" name="username" value="' . $_SESSION['LoginValues']['username'] . '" maxlength="30" id="username" /> ' .

					'<label for="password">Lösenord : </label>' .
					'<input type="password" name="password" maxlength="30" id="password" /> ' .

					'<label for="rememberMe">Håll mig inloggad :</label>
					<input id="rememberMe" type="checkbox" name="rememberMe">
					<input type="submit" name="submit" id="submit" value="Logga in" />
				</fieldset>
			</form>';

			$_SESSION['LoginValues']['username'] = "";

			return $loginHTML;			
		}

		public function GetUsername () {

			// Is called from LoginController
			if (isset($_POST['username'])) {
				
				return $_POST['username'];
			}
		}

		public function GetPassword () {

			// Is called from LoginController
			if (isset($_POST['password'])) {
				
				return $_POST['password'];
			}
		}

		public function UserPressLoginButton () {

			return isset($_POST['submit']);
		}

		public function Validate () {

			if ($this->GetUsername() == null) {

				return self::$emptyUsernameErrorMessage;
			}

			else if ($this->GetPassword() == null) {

				$_SESSION['LoginValues']['username'] = $this->GetUsername();

				return self::$emptyPasswordErrorMessage;
			}

			return true;
		}

		public function AutoLoginIsChecked () {

			$isChecked = false;

			if (isset($_POST['rememberMe'])) {
				
				$isChecked = $_POST['rememberMe'];
			}

			return ($isChecked == 'true' || $isChecked == 'on') ? true : false;
		}

		public function SaveUserCredentials ($username, $password, $cookieTimestamp) {

			$this->cookieStorage->SaveUserCredentials($username, $password, $cookieTimestamp);
		}

		public function DeleteUserCredentials () {

			$this->cookieStorage->DeleteUserCredentials();
		}

		public function RememberMe () {

			$this->cookieStorage->RememberMe();
		}

		public function GetLoginErrorMessage () {

			$errorMessage;
			$_SESSION['LoginValues']['username'] = $this->GetUsername();

			return self::$loginErrorMessage;
		}
	}