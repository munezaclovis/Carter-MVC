<?php
namespace Core;

class View{

	protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

	public function __construct(){

	}

	public function render($viewName, $params = array()){
		if (count($params) > 0) {
			if (is_object($params)) {
				foreach ($params as $key => $value){
					$$key = isset($params[$key]) ? $params[$key] : FALSE;
				}	
			}elseif(is_array($params)){
				foreach ($params as $key => $value) {
					if (is_array($value)) {
						$$key = isset($params[$key]) ? $params[$key] : FALSE;
					}elseif (is_object($value)) {
						$$key = $params[$key];
					}else{
						$$key = $params[$key];
					}
				}
			}
		}

		$viewArray = explode('/', $viewName);
		$viewString = implode(DS, $viewArray);

		if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')) {
			include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
			include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
		}else{
			die('The view "<b>' . $viewName . '<b/>" does not exist.');
		}
	}

	public function content($type){
		if ($type == 'head') {
			return $this->_head;
		}elseif ($type == 'body') {
			return $this->_body;
		}else{
			return false;
		}
	}


	public function start($type){
		$this->_outputBuffer = $type;
		ob_start();
	}

	public function end(){
		if ($this->_outputBuffer == 'head') {
			$this->_head = ob_get_clean();
		}elseif($this->_outputBuffer == 'body'){
			$this->_body = ob_get_clean();
		}else{
			die("You must first run the start method");
		}
	}

	public function siteTitle(){
		return $this->_siteTitle;
	}

	public function setSiteTitle($title){
		$this->_siteTitle = $title;
	}

	public function setLayout($path){
		$this->_layout = $path;
	}

	public function insert($path){
		include ROOT . DS . 'app' . DS . 'views' . DS . $path . '.php';
	}

	public function partial($group, $partial, $params = []){
		if (count($params) > 0) {
			foreach ($params as $key => $value){
				$$key = isset($params[$key]) ? $params[$key] : FALSE;
			}
		}
		include ROOT . DS . 'app' . DS . 'views' . DS . $group . DS . 'partials' . DS . $partial . '.php';
	}
}