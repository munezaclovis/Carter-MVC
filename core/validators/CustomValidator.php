<?php 
namespace Core\Validators;
use \Exception;
use Core\H;

abstract class CustomValidator{
	public $success=true, $msg = '', $field, $rule, $display, $errorField;
	protected $_model;

	public function __construct($model, $params){
		$this->_model = $model;
		
		if (!array_key_exists('field', $params)) {
			throw new Exception("You must add a \"field\" to the \"params\" array");
		}else{
			$this->field = (is_array($params['field'])) ? $params['field'][0] : $params['field'];
		}

		if (!property_exists($model, $this->field)) {
			throw new Exception("Field must exist in the model");
		}

		if (array_key_exists('msg', $params)) {
			$this->msg = $params['msg'];
		}

		if (array_key_exists('rule', $params)) {
			$this->rule = $params['rule'];
		}

		if (!array_key_exists('display', $params)) {
			$this->display = $this->field;
		}else{
			$this->display = $params['display'];
		}

		if (!array_key_exists('errorField', $params)) {
			$this->errorField = $this->field;
		}else{
			$this->errorField = $params['errorField'];
		}

		try{
			$this->success = $this->runValidation();
		}catch(Exception $e){
			echo "Validation Exception" . get_class() . ": " . $e->getMessage() . "</br>";
		}
	}

	public abstract function runValidation();
}