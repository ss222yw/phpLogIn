<?php
	require_once(ViewPath.DS.'CookieStorage.php');

	class LoginView {

		private static $loginErrorMessage = "Felaktigt användarnamn och/eller lösenord.";
		private static $emptyUsernameErrorMessage = "Användarnamn saknas.";
		private static $emptyPasswordErrorMessage = "Lösenord saknas.";

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

					'<label for="autologin">Håll mig inloggad :</label>
					<input id="autologin" type="checkbox" name="LoginView::Checked">
					<input type="submit" name="submit" id="login" value="Logga in" />
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

			// else if ($this->GetUsername() == null && $this->GetPassword() == null) {

			// 	$errors['username'] = 'Användarnamn saknas';
			// 	$errors['password'] = 'Lösenord saknas';
			// }

			// If no errors, username and password are validated (true), otherwise false.
			return true;
		}

		public function GetLoginErrorMessage () {

			$errorMessage;
			$_SESSION['LoginValues']['username'] = $this->GetUsername();

			return self::$loginErrorMessage;
		}
	}