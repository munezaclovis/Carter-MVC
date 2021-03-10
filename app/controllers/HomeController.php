<?php
namespace App\Controllers;
use Core\Controller;

class HomeController extends Controller{

	function __construct($controller, $method){
		parent::__construct($controller, $method);
		$this->view->setLayout('default');
	}

	public function index(){
		$this->view->render("home/index");
	}
}