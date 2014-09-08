<?php
	require_once("../data/pathConfig.php");

	$mainView = new HTMLView();

	$loginController = new LoginController();

	$loginHTML = $loginController->DisplayLogin();



	if ($loginController->UserLogin()) {
		
		$loginController->AuthenticateUser();
	}

	echo $mainView->echoHTML($loginHTML);