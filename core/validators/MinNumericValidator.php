<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class MinNumericValidator extends CustomValidator
{
	
	public function runValidation(){
		$value = $this->_model->{$this->field};
		$pass = ($value >= $this->rule);
		if($this->msg == '') $this->msg = "{$this->display} must be greater or equal {$this->rule}";
		return $pass;	
	}
}