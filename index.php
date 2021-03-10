<?php

use App\Models\Users;
use Core\Cookie;
use Core\H;
use Core\Router;
use Core\Session;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);

require_once ROOT . DS . 'config' . DS . 'constants.php';

function autoload($className) {
	$classAry = explode('\\', $className);
	$class = array_pop($classAry);
	
	$subPath = strtolower(implode(DS, $classAry));
	$path = ROOT . DS . $subPath . DS . $class . '.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

spl_autoload_register('autoload');

session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];

if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
	Users::loginUserFromCookie();
}
//Route the request
Router::route($url);
