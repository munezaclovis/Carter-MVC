<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class MaxNumericValidator extends CustomValidator
{
	
	public function runValidation(){
		$value = $this->_model->{$this->field};
		$pass = ($value <= $this->rule);
		if($this->msg == '') $this->msg = "{$this->display} must be less than {$this->rule}";
		return $pass;	
	}
}