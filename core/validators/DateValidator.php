<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;

/**
 * 
 */
class DateValidator extends CustomValidator
{
	
	public function runValidation(){
		$date = $this->_model->{$this->field};
		$pass = true;
		if (!empty($date)) {
			$dateArry = explode('-', $date);
			if($dateArry[0] == 0 || $dateArry[1] == 0 || $dateArry[2] == 0){
				$pass = false;
				$this->msg == 'Please choose a valid Date';
			}

			if(sizeof($dateArry) == 3){
				$pass = checkdate($dateArry[1], $dateArry[2], $dateArry[0]);
			}else{
				$pass = false;
			}
		}
		if($this->msg == '') $this->msg = "Please choose a valid Date";
		return $pass;
	}
}