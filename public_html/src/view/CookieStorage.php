<?php

	class CookieStorage {

		// private static $cookieName = "CookieStorage";
		public $username;
		public $password;
		private static $usernameCookie = "username";
		private static $passwordCookie = "password";

		public function SaveUserCredentials ($username, $password, $cookieTimestamp) {

			$hashedPassword = hash("sha256", $password);
			setcookie(self::$usernameCookie, $username, $cookieTimestamp, "/");
			setcookie(self::$passwordCookie, $hashedPassword, $cookieTimestamp, "/");
		}

		public function DeleteUserCredentials () {

			setcookie(self::$usernameCookie, "", 1, "/");
			setcookie(self::$passwordCookie, "", 1, "/");
		}

		public function RememberMe () {

			return isset($_COOKIE["username"]);
		}

		public function UserCredentialManipulated ($username, $password) {


		}
	}