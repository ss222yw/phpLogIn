<?php
	require_once("../data/pathConfig.php");

	$mainView = new HTMLView();

	$loginController = new LoginController();

	$loginHTML = $loginController->DisplayLogin();

	if ($loginController->IsLoggedIn()) {
		
		echo "Logged In!";
	}


	if ($loginController->UserPressLoginButton() || $loginController->IsValidSession()) {
		
		$memberHTML = $loginController->AuthenticateUser();

		if ($loginController->IsLoggedIn()) {
			
			echo $mainView->echoHTML($memberHTML);
		}
	} else {

		echo $mainView->echoHTML($loginHTML);		
	}

	$loginController->UserPresssLogoutButton();
	// if ($loginController->UserPresssLogoutButton()) {
		
	// 	unset($_SESSION['valid']);
	// }

	// if (!$loginController->IsLoggedIn()) {
		
	// 	echo $mainView->echoHTML($loginHTML);
	// }

	