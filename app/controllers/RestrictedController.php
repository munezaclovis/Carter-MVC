<?php
namespace App\Controllers;
use Core\Controller;

/**
 * 
 */
class RestrictedController extends Controller
{
	
	function __construct($controller, $method){
		parent::__construct($controller, $method);
		$this->view->setLayout('default');
	}

	public function index(){
		$this->view->render("restricted/index");
	}

	public function badtoken(){
		$this->view->render("restricted/badtoken");
	}
}