<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class MinValidator extends CustomValidator
{
	
	public function runValidation(){
		$value = $this->_model->{$this->field};
		$pass = (strlen($value) >= $this->rule);
		if($this->msg == '') $this->msg = "{$this->display} must be at least {$this->rule} Characters";
		return $pass;	
	}
}