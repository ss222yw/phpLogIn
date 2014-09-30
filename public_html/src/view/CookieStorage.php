<?php

	class CookieStorage {

		public $username;
		public $password;
		private static $usernameCookie = "username";
		private static $passwordCookie = "password";
		private static $cookieUsernameErrMsg = 'CookieUsername does not exist!';
		private static $cookiePasswordErrMsg = 'CookiePassword does not exist!';

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

			return isset($_COOKIE[self::$usernameCookie]);
		}

		public function GetCookieUsername () {

			if (isset($_COOKIE[self::$usernameCookie])) {
				
				return $_COOKIE[self::$usernameCookie];
			}
			//else {
//
//				throw new \Exception(self::$cookieUsernameErrMsg);
//			}
		}

		public function GetCookiePassword () {

			if (isset($_COOKIE[self::$passwordCookie])) {
				
				return $_COOKIE[self::$passwordCookie];
			}
			else {	

				throw new \Exception(self::$cookiePasswordErrMsg);
			}
		}		
	}