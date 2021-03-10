<?php
namespace Core;
use Core\Application;

class Controller extends Application{

	protected $_controller, $method;
	public $view, $request, $config;


	public function __construct($controller, $method){
		parent::__construct();

		$this->_controller = $controller;
		$this->_method = $method;
		$this->request = new Input();
		$this->view = new View();
		$this->config =& H::get_config();
	}

	protected function load_model($model){
		$modelPath = 'App\Models\\' . $model;
		if (class_exists($modelPath)) {
			$this->{$model.'Model'} = new $modelPath;
		}
	}

	public function jsonResponse($resp){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: applicaton/json; charset=UTF-8");
		http_response_code(200);
		echo json_encode($resp);
		exit;
	}
}