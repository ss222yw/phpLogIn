<?php

require_once(HelperPath.DS.'HTMLView.php');

class RegView{

	private $mainView;
	private $username = "username";
	private $passwordOne = "password";
	private $passwordTwo = "passwordTwo";
	private $safe;

	private static $ErrorUserNameMessage = "Användarnamnet har för få tecken. Minst 3 tecken";
	private static $ErrorPasswordMessage = "Lösenorden har för få tecken. Minst 6 tecken";
	private static $ErrorDiffrentPasswordMessage = "Lösenorden matchar inte";
	private static $ErrorHasTagsUsernameMessage = "Användarnamnet innehåller ogiltiga tecken";
	private static $ErrorUserHasToken = "Användarnamnet är upptaget!";
	private static $ErrorPasswordAndUserNameMessage = "Användarnamnet har för få tecken. Minst 3 tecken <br> Lösenorden har för få tecken. Minst 6 tecken";


	public function __construct() {

		$this->mainView = new HTMLView();
		$this->safe = new safe();
		
	}

	public function getSafePassword() {
			# code...
			return $this->safe->create_hash($this->GetPasswordOne());
		
	}

	public function GetRegFormHTML($message = '') {

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
					'<label for="'.$this->username.'">Namn :  </label>' .
					'<input type="text" name="'.$this->username.'" value="'.strip_tags($this->GetUserName()). '" maxlength="30" id="username" /> ' .
					'<br>'.
					'<label for="'.$this->passwordOne.'">Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordOne.'" maxlength="30" id="password" /> ' .
					'<br>'.
					'<label for="'.$this->passwordTwo.'">Reptera Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordTwo.'" maxlength="30" id="passwordTwo" /> ' .
					'<br>'.
					'<label for="Registrera">Skicka : </label>' .
					'<input type="submit" name="Registrera" id="submit" value="Registrera" />
				    </fieldset>
					</form>';
			return $RegHTML;

	}

	public function RenderRegForm($errorMessage = '') {

			$RegHTML = $this->GetRegFormHTML($errorMessage);
			echo $this->mainView->echoHTML($RegHTML);
		}


	public function GetUserName() {
		if (isset($_POST[$this->username])) {
			return $_POST[$this->username];
		}
	}


	public function GetPasswordOne() {
		if (isset($_POST[$this->passwordOne])) {
			return $_POST[$this->passwordOne];
		}	
	}

	public function GetPasswordTwo() {
		if (isset($_POST[$this->passwordTwo])) {
			return $_POST[$this->passwordTwo];
		}
	}


	public function UserPressReturn() {
		if (isset($_GET['login'])) {
			# code...
			return true;
		}
		
	}

	public function DidUserPressReg() {
		if (isset($_POST['Registrera'])) {
			return true;
		}
		
	}

	public function validateUserIfEX() {
		return self::$ErrorUserHasToken;
	}

	public function ValidateRegistration () {

			if (mb_strlen($this->GetUserName()) < 3 && mb_strlen($this->GetPasswordOne()) < 6) {
				return self::$ErrorPasswordAndUserNameMessage;
			}

		    if ($this->GetUserName() == null || mb_strlen($this->GetUserName()) < 3) {

				return self::$ErrorUserNameMessage;
			}
			
			else if ($this->GetPasswordOne() == null || mb_strlen($this->GetPasswordOne()) < 6) {
		
				return self::$ErrorPasswordMessage;
			}
			else if ($this->GetPasswordTwo() == null || mb_strlen($this->GetPasswordTwo()) < 6) {
		
				return self::$ErrorPasswordMessage;
			}
			else  if($this->GetUserName() != strip_tags($this->GetUserName())) {

				return self::$ErrorHasTagsUsernameMessage;
			}	
			else if($this->GetPasswordOne() != $this->GetPasswordTwo()) {

				return self::$ErrorDiffrentPasswordMessage;
			}		
				return true;	
		
		}


}