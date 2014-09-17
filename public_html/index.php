<?php
	session_start();

	if (!isset($_SESSION['LoginValues'])) {
		
		// $_SESSION['LoginValues']['username'] = '';
	}

	require_once("../data/pathConfig.php");

	$loginController = new LoginController();

	// Run Application
	$loginController->RunLoginLogic();

	