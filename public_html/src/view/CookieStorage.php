<?php

	class CookieStorage {

		// private static $cookieName = "CookieStorage";
		private static $errorCookieName = "errors";

			// public function save($string) {

			// 	// $string is the value to save in the cookie.
			// 	setcookie( self::$cookieName, $string, -1);
			// 	//var_dump($_COOKIE);
			// 	//die();
			// }

			public function SetErrorMessage ($key, $value) {

				setcookie(self::$errorCookieName . '[' . $key . ']', $value, -1, "/");
			}

			public function DeleteErrorMessage () {

				setcookie(self::$errorCookieName, "", 1, "/");
			}
	}