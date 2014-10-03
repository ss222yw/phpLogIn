<?php
	
	// DEFINE CORE PATHS (absolute).
	
	// Define a short for directory separator.
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	// Define a project root path.
	defined('ProjectRootPath') ? null : define('ProjectRootPath', 'C:'.DS.'NewphpLogIn'.DS.'phpLogIn');
	
	// Define helper path.
	defined('HelperPath') ? null : define('HelperPath', ProjectRootPath.DS.'data');
	// Define MVC path.
	defined('ModelPath') ? null : define('ModelPath', ProjectRootPath.DS.'public_html/src/model');
	defined('ViewPath') ? null : define('ViewPath', ProjectRootPath.DS.'public_html/src/view');
	defined('ControllerPath') ? null : define('ControllerPath', ProjectRootPath.DS.'public_html/src/controller');

	// REQUIRE NEEDED FILES BELOW.
	// REQUIRE HELPERS
	require_once(HelperPath.DS.'config.php');

	// require database model (helper)
	require_once(HelperPath.DS.'SessionModel.php');
	require_once(HelperPath.DS.'Database.php');

	// REQUIRE MODELS
	require_once(ModelPath.DS.'UserModel.php');
	require_once(ModelPath.DS.'User.php');

	// REQUIRE VIEWS
	require_once(HelperPath.DS.'HTMLView.php');
	require_once(ViewPath.DS.'LoginView.php');
	require_once(ViewPath.DS.'MemberView.php');
	require_once(ViewPath.DS.'CookieStorage.php');
	require_once(ViewPath.DS.'RegView.php');

	// REQUIRE CONTROLLERS
	require_once(ControllerPath.DS.'LoginController.php');
	require_once(HelperPath.DS.'safe.php');
	require_once(HelperPath.DS.'setting.php');