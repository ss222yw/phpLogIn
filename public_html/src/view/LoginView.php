<?php
	class LoginView {

		public function ShowLoginForm () {

			$loginHTML = '<form id="login" enctype="multipart/form-data" method="post">
				<div class="loginField">
					<label for="username">Enter Username</label><br />
					<input type="text" name="username" maxlength="30" id="username" /><br />
				</div>
				<div class="loginField">
					<label for="password">Enter Password</label><br />
					<input type="password" name="password" maxlength="30" id="password" /><br />
				</div>

				<div class="button">
					<input type="submit" name="submit" id="login" value="Log In" />
				</div>
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