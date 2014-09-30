<?php

require_once(HelperPath.DS.'HTMLView.php');

class RegView{

	private $mainView;
	private $username = "username";
<<<<<<< HEAD
	private $passwordOne = "password";
	private $passwordTwo = "passwordTwo";
//	private $userId = "userId";
=======
	private $passwordOne = "passwordOne";
	private $passwordTwo = "passwordTwo";
>>>>>>> origin/master

	private static $ErrorUserNameMessage = "Användarnamnet har för få tecken. Minst 3 tecken";
	private static $ErrorPasswordMessage = "Lösenorden har för få tecken. Minst 6 tecken";
	private static $ErrorDiffrentPasswordMessage = "Lösenorden matchar inte";
	private static $ErrorHasTagsUsernameMessage = "Användarnamnet innehåller ogiltiga tecken";
<<<<<<< HEAD
	private static $ErrorUserHasToken = "Användarnamnet är upptaget!";
=======
>>>>>>> origin/master

	public function __construct(){

		$this->mainView = new HTMLView();
		
	}

	public function GetRegFormHTML($message = ''){

		$responseMessages = '';

			if ($message != '') {
					
				$responseMessages .= '<p>' . $message . '</p>';
			}


		$RegHTML =
		'<h1>Laboration login del två</h1>'.

		'<a href="?login">Tillbaka</a>'.

		'<h2>Ej Inloggad, Registrerar användare</h2> '.

		'<form  enctype="multipart/form-data" method="post" action="?Registrera">' .
		'<fieldset>' .
					'<legend>Registrera ny användare - Skriv in användarnamn och lösenord</legend>' .
					$responseMessages .
					'<label for="'.$this->username.'">Namn : </label>' .
<<<<<<< HEAD
					'<input type="text" name="'.$this->username.'" value="'. $_SESSION['LoginValues']['username'] . '" maxlength="30" id="username" /> ' .

					'<label for="'.$this->passwordOne.'">Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordOne.'" maxlength="30" id="password" /> ' .
=======
					'<input type="text" name="'.$this->username.'" value="" maxlength="30" id="username" /> ' .

					'<label for="'.$this->passwordOne.'">Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordOne.'" maxlength="30" id="passwordOne" /> ' .
>>>>>>> origin/master

					'<label for="'.$this->passwordTwo.'">Reptera Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordTwo.'" maxlength="30" id="passwordTwo" /> ' .

					'<label for="Registrera">Skicka : </label>' .
					'<input type="submit" name="Registrera" id="submit" value="Registrera" />
		  </fieldset>
			</form>';
			return $RegHTML;

	}

	public function RenderRegForm($errorMessage = '') {

<<<<<<< HEAD
			$RegHTML = $this->GetRegFormHTML($errorMessage);
=======
			$RegHTML = $this->GetRegFormHTML();
>>>>>>> origin/master
			echo $this->mainView->echoHTML($RegHTML);
		}


	public function GetUserName(){
<<<<<<< HEAD
=======

>>>>>>> origin/master
		if (isset($_POST[$this->username])) {
			# code...
			return $_POST[$this->username];
		}
	}

<<<<<<< HEAD
//	public function GetUserId(){
//		return $this->userId;
//	}

	public function GetPasswordOne(){
		if (isset($_POST[$this->passwordOne])) {
			# code...
			return $_POST[$this->passwordOne];
		}	
=======
	public function GetPasswordOne(){

		if (isset($_POST[$this->passwordOne])) {
			# code...
			return $_POST[$this->passwordOne];
		}
>>>>>>> origin/master
	}

	public function GetPasswordTwo(){
		if (isset($_POST[$this->passwordTwo])) {
			# code...
			return $_POST[$this->passwordTwo];
		}
	}


	public function UserPressReturn(){
		if (isset($_GET['login'])) {
			# code...
			return true;
		}
		
	}

	public function DidUserPressReg(){
		if (isset($_POST['Registrera'])) {
			# code...
			return true;
		}
		
	}

<<<<<<< HEAD
	public function validateUserIfEX(){
		return self::$ErrorUserHasToken;
	}

	public function ValidateRegistration () {
		
=======
	public function ValidateRegistration () {

>>>>>>> origin/master
			if ($this->GetUserName() == null || mb_strlen($this->GetUserName()) < 3) {

				return self::$ErrorUserNameMessage;
			}
			else if($this->GetUserName() != strip_tags($this->GetUserName())){

				return self::$ErrorHasTagsUsernameMessage;
			}
<<<<<<< HEAD
			else if ($this->GetPasswordOne() == null || mb_strlen($this->GetPasswordOne()) < 6) {
		
				return self::$ErrorPasswordMessage;
			}
			else if($this->GetPasswordOne() != $this->GetPasswordTwo()){

				return self::$ErrorDiffrentPasswordMessage;
			}		
				return true;	
		
		}

=======
			else if ($this->GetPasswordOne() == null || $this->GetPasswordOne() < 6) {

				return self::$ErrorPasswordMessage;
			}
			else if($this->GetPasswordTwo() == null || $this->GetPasswordTwo() < 6){

				return self::$ErrorPasswordMessage;
			}
			else if($this->GetPasswordOne() != $GetPasswordTwo()){

				return self::$ErrorDiffrentPasswordMessage;
			}

			return true;
		}

		public function addNewUser(){


		}


>>>>>>> origin/master
}