<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class EmailValidator extends CustomValidator
{
	
	public function runValidation(){
		$email = $this->_model->{$this->field};
		$pass = true;
		if (!empty($email)) {
			$pass = filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		if($this->msg == '') $this->msg = "Email is not valid, Please enter a valid Email";
		return $pass;
	}
}