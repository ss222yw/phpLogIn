<?php
	class LoginController {

		// REMINDER: WHEN CREATING MODELS, THE MODEL MIGHT HAVE TO INHERIT FROM THE DATABASE OBJECTS IN THE HELPERS FOLDER?

		private $loginView;

		function __construct () {

			echo 'LoginController is instantiated in a member of this controller class.';
		}

		public function displayLogin () {

			return 'Loginform is displayed!';
		}
	}