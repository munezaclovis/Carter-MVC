<?php

namespace Core;
use Core\Session;
use App\Models\Users;
use Core\H;

class Router{

	public static function route($url){

		//controller
		$controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) . 'Controller' : DEFAULT_CONTROLLER . 'Controller';
		$controller_name = str_replace('Controller', '', $controller);
		array_shift($url);


		//action or method
		$method = (isset($url[0]) && $url[0] != '') ? $url[0] : 'index';
		$method_name = (isset($url[0]) && $url[0] != '') ? $method : "index";
		array_shift($url);

		//acl check
		$grantAccess = self::hasAccess($controller_name, $method_name);
		if (!$grantAccess) {
			$controller = ACCESS_RESTRICTED.'Controller';
			$controller_name = ACCESS_RESTRICTED;
			$method = "index";
		}

		//parameters
		$params = $url;
		$controller = 'App\Controllers\\' . $controller;
		
		//create an instance from the controller name
		$dispatch = new $controller($controller_name, $method);

		if (method_exists($controller, $method)) {
			call_user_func_array([$dispatch, $method], $params);
		}else{
			die('Method "<b>' . $method . '</b>" Does not exist in the controller "<b>' . $controller_name . '</b>"');
		}
	}

	public static function redirect($location){
		if (!headers_sent()) {
			header('location:' . PROOT . $location);
			exit();
		}else{
			echo '<script type="text/javascript"';
			echo 'window.location.href="' . PROOT . $location . '";';
			echo '</script>';
			
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
			echo '</noscript>';
			exit();
		}
	}

	public static function hasAccess($controller_name, $method_name='index') {
		$acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
		$acl = json_decode($acl_file, true);
		$current_user_acls = ["Guest"];
		$grantAccess = false;

		if(Session::exists(CURRENT_USER_SESSION_NAME)) {
			$current_user_acls[] = "LoggedIn";
	
			foreach(Users::currentUser()->acls() as $a) {
				$current_user_acls[] = $a;
			}
		}

		foreach($current_user_acls as $level) {
			if(array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])) {
				if(in_array($method_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])) {
					$grantAccess = true;
					break;
				}
			}
		}

		//check for denied
		foreach($current_user_acls as $level) {
			$denied = (array_key_exists('denied', $acl[$level])) ? $acl[$level]['denied'] : [];
			if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($method_name, $denied[$controller_name])) {
				$grantAccess = false;
				break;
			}
		}
		return $grantAccess;
    }

	public static function getMenu($menu){
		$menuAry = [];
		$acl = json_decode(file_get_contents(ROOT . DS . 'app' . DS . $menu . '.json'), true);
		foreach($acl as $key => $val) {
			if(is_array($val)) {
				$sub = [];
				foreach($val as $k => $v) {
					if($k == 'separator' && !empty($sub)) {
						$sub[$k] = '';
						continue;
					}else if($finalVal = self::get_link($v)) {
						$sub[$k] = $finalVal;
					}
				}
				if(!empty($sub)) {
					$menuAry[$key] = $sub;
				}
			} else {
				if($key == 'separator' && !empty($menuAry)) {
					$menuAry[$key] = '';
					continue;
				}
				if($finalVal = self::get_link($val)) {
					$menuAry[$key] = $finalVal;
				}
			}
		}
		return $menuAry;
	}

	private static function get_link($val) {
      //check if external link
		if(preg_match('/https?:\/\//', $val) == 1) {
			return $val;
		} else {
			$uAry = explode("/", $val);
			$controller_name = ucwords($uAry[0]);
			$method_name = (isset($uAry[1]))? $uAry[1] : '';
			
			if(self::hasAccess($controller_name, $method_name)) {
				return PROOT . $val;
			}
			return false;
		}
    }
}