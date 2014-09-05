<?php
	
	// DEFINE CORE PATHS (absolute).
	
	// Define a short for directory separator.
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

	// Define a project root path.
	defined('ProjectRootPath') ? null :
		define('ProjectRootPath', 'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'www'.DS.'git'.DS.'phpLogIn');

	// Define helper path.
	defined('HelperPath') ? null : define('HelperPath', ProjectRootPath.DS.'data');

	// Define MVC path.
	defined('ModelPath') ? null : define('ModelPath', ProjectRootPath.DS.'public_html/src/model');
	defined('ViewPath') ? null : define('ViewPath', ProjectRootPath.DS.'public_html/src/view');
	defined('ControllerPath') ? null : define('ControllerPath', ProjectRootPath.DS.'public_html/src/controller');

	// REQUIRE NEEDED FILES BELOW.
	require_once('config.php');
	require_once('Database.php');
	require_once('../public_html/src/controller/LoginController.php');

