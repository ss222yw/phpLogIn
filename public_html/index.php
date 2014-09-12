<?php
	session_start();
	require_once("../data/pathConfig.php");

	$loginController = new LoginController();

	// Run Application
	$loginController->RunLoginLogic();

	