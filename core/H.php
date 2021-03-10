<?php

namespace Core;

/**
 * 
 */
class H
{
	
	public static function dnd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die();
	}

	public static function d($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}


	public static function pnd($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}

	public static function p($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	public static function currentUser(){
		return Users::currentLoggedInUser();
	}

	public static function currentPage(){
		$currentPage = $_SERVER['REQUEST_URI'];
		if($currentPage == PROOT || $currentPage == PROOT.'home/index'){
			$currentPage = PROOT.'home';
		}
		return $currentPage;
	}

	public static function getObjectProperties($obj){
		return get_object_vars($obj);
	}

	public static function password_hash($password){
		return password_hash($password, PASSWORD_DEFAULT);
	}

	public static function &get_config(Array $replace = array())
	{
		static $config;

		if (empty($config))
		{
			if (file_exists(ROOT. DS . 'config' . DS. 'config.php'))
			{
				require(ROOT. DS . 'config' . DS. 'config.php');
			}
		}

		// Are any values being dynamically added or replaced?
		foreach ($replace as $key => $val)
		{
			$config[$key] = $val;
		}
		
		return $config;
	}
}