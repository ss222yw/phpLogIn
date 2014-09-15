<?php

	class Validator {

		public function ValidateUsername ($username) {

			return $username == null;
		}

		public function ValidatePassword ($password) {

			return $password == null;
		}

		public function Validate ($validationRool, $value) {

			$errorExist = false;

			switch ($validationRool) {

				case 'username':
					
					if ($value == null) {
						
						$_COOKIE['errors']['username'] = 'Användarnamn måste anges.';
						$errorExist = true;
					}
					break;

				case 'password':
					if ($value == null) {
						
						$_COOKIE['errors']['password'] = 'Lösenord måste anges.';
						$errorExist = true;
					}
					break;
			}

			return !$errorExist ? true : false;
		}
	}