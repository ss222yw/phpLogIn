<?php
	require_once("../data/pathConfig.php");

	$loginController = new LoginController();

	$loginHTML = $loginController->displayLogin();
	echo $loginHTML;
