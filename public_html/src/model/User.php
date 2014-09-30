<?php

class User{

<<<<<<< HEAD
	//private $userId;
	private $username;
	private $password;
	
=======
	private $userId;
	private $username;
	private $password;

>>>>>>> origin/master

	public function __construct($username,$password){

		$this->username = $username;
		$this->password = $password;
<<<<<<< HEAD
	//	$this->userId = $userId;
=======
>>>>>>> origin/master
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPasswrod(){
		return $this->password;
	}
<<<<<<< HEAD

//	public function getUserId(){
//		return $this->userId;
//	}
=======
>>>>>>> origin/master
}