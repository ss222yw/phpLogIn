<?php

require_once(HelperPath.DS.'HTMLView.php');

class RegView{

	private $mainView;
	private $username = "username";
	private $passwordOne = "passwordOne";
	private $passwordTwo = "passwordTwo";

	private static $ErrorUserNameMessage = "Användarnamnet har för få tecken. Minst 3 tecken";
	private static $ErrorPasswordMessage = "Lösenorden har för få tecken. Minst 6 tecken";
	private static $ErrorDiffrentPasswordMessage = "Lösenorden matchar inte";
	private static $ErrorHasTagsUsernameMessage = "Användarnamnet innehåller ogiltiga tecken";

	public function __construct(){

		$this->mainView = new HTMLView();
	}

	public function GetRegFormHTML(){

		$RegHTML =
		'<h1>Laboration login del två</h1>'.

		'<a href="?login">Tillbaka</a>'.

		'<h2>Ej Inloggad, Registrerar användare</h2> '.

		'<form  enctype="multipart/form-data" method="post" action="">' .
		'<fieldset>' .
					'<legend>Registrera ny användare - Skriv in användarnamn och lösenord</legend>' .
					$responseMessages .
					'<label for="'.$this->username.'">Namn : </label>' .
					'<input type="text" name="'.$this->username.'" value="" maxlength="30" id="username" /> ' .

					'<label for="'.$this->passwordOne.'">Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordOne.'" maxlength="30" id="passwordOne" /> ' .

					'<label for="'.$this->passwordTwo.'">Reptera Lösenord : </label>' .
					'<input type="password" name="'.$this->passwordTwo.'" maxlength="30" id="passwordTwo" /> ' .

					'<label for="Registrera">Skicka : </label>' .
					'<input type="submit" name="Registrera" id="submit" value="Registrera" />
		  </fieldset>
			</form>';
			return $ReqHTML;

	}


	public function GetUserName(){

		if (isset($_POST[$this->username])) {
			# code...
			return $this->username;
		}
	}

	public function GetPasswordOne(){

		if (isset($_POST[$this->passwordOne])) {
			# code...
			return $this->passwordOne;
		}
	}

	public function GetPasswordTwo(){
		if (isset($_POST[$this->passwordTwo])) {
			# code...
			return $this->passwordTwo;
		}
	}

	public function UserPressReg(){
		return isset($_POST[$this->ReqSubmit]);
	}

	public function UserPressReturn(){
		if (isset($_GET['?login'])) {
			# code...
			return true;
		}
		return false;
	}

	public function ValidateRegistration () {

			if ($this->GetUserName() == null || mb_strlen($this->GetUserName()) < 3) {

				return self::$ErrorUserNameMessage;
			}
			else if($this->GetUserName() != strip_tags($this->GetUserName())){

				return self::$ErrorHasTagsUsernameMessage;
			}
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


}