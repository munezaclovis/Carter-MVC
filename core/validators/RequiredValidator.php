<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class RequiredValidator extends CustomValidator
{
	
	public function runValidation(){
		$value = $this->_model->{$this->field};
		$pass = (!empty($value));
		if($this->msg == '') $this->msg = "{$this->display} is required";
		return $pass;
	}
}