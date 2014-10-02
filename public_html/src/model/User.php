<?php

class User{

	//private $userId;
	private $username;
	private $password;
	

	public function __construct($username,$password){

		$this->username = $username;
		$this->password = $password;
	//	$this->userId = $userId;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPasswrod(){
		return $this->password;
	}

//	public function getUserId(){
//		return $this->userId;
//	}
}