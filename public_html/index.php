<?php
	session_start();
	require_once("../data/pathConfig.php");

	$loginController = new LoginController();
	$mainView = new HTMLView();

	$loginHTML = $loginController->GetLoginFormHTML();
	$memberHTML = $loginController->GetMemberStartHTML();
	$userAuthenticated = false;

	// Logout with redirect before headers are sent.
	if ($loginController->UserPressLogoutButton()) {
		
		$loginController->LogoutUser();
	}

	if ($loginController->UserPressLoginButton() || $loginController->IsLoggedIn()) {
		
		if (!$loginController->IsLoggedIn()) {
			
			$userAuthenticated = $loginController->AuthenticateUser();

			// If comparison to database succeeded
			if ($userAuthenticated) {
				
				echo $mainView->echoHTML($memberHTML);
			}
			else {

				var_dump("Error!");
			}
		}
		else {
			// var_dump('already logged in');
			echo $mainView->echoHTML($memberHTML);
		}
	}
	else {

		echo $mainView->echoHTML($loginHTML);
	}

	