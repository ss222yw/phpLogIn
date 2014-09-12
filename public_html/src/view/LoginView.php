<?php
	class LoginView {

		public function GetLoginFormHTML () {

			$loginHTML = 
			'<h2>Ej Inloggad</h2>

			<form id="login" enctype="multipart/form-data" method="post">
				<fieldset>
					<legend>Login - Skriv in användarnamn och lösenord</legend>
					<label for="username">Användarnamn : </label>
					<input type="text" name="username" maxlength="30" id="username" />

					<label for="password">Lösenord : </label>
					<input type="password" name="password" maxlength="30" id="password" />

					<label for="autologin">Håll mig inloggad :</label>
					<input id="autologin" type="checkbox" name="LoginView::Checked">
					<input type="submit" name="submit" id="login" value="Logga in" />
				</fieldset>
			</form>';

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
	}