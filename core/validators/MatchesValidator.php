<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class MatchesValidator extends CustomValidator
{
	
	public function runValidation(){
		$value = $this->_model->{$this->field};
		if($this->msg == '') $this->msg = "{$this->display} Does not match";
		return $value == $this->rule;
	}
}