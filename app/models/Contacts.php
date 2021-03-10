<?php
namespace App\Models;
use Core\Model;
use App\Models\Users;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\NumericValidator;
use Core\Validators\RequiredValidator;

/**
 * 
 */
class Contacts extends Model
{
	public $id, $user_id, $fname, $lname, $email, $address, $address2, $city, $state, $zip, $home_phone, $work_phone, $cell_phone, $deleted = 0;
	protected static $_table = 'contacts';
	

	public function validator(){

		$this->runValidation(new MinValidator($this, ['field'=>'fname', 'display'=>'First Name', 'errorField'=>'fname', 'rule'=>1]));
		$this->runValidation(new MinValidator($this, ['field'=>'lname', 'display'=>'Last Name', 'errorField'=>'lname', 'rule'=>1]));


		$this->runValidation(new MaxValidator($this, ['field'=>'fname', 'display'=>'First Name', 'errorField'=>'fname', 'rule'=>50]));
		$this->runValidation(new MaxValidator($this, ['field'=>'lname', 'display'=>'Last Name', 'errorField'=>'lname', 'rule'=>50]));
		$this->runValidation(new MaxValidator($this, ['field'=>'work_phone', 'display'=>'Work Phone', 'errorField'=>'work_phone', 'rule'=>17]));
		$this->runValidation(new MaxValidator($this, ['field'=>'cell_phone', 'display'=>'Cell Phone', 'errorField'=>'cell_phone', 'rule'=>17]));
		$this->runValidation(new MaxValidator($this, ['field'=>'home_phone', 'display'=>'Home Phone', 'errorField'=>'home_phone', 'rule'=>17]));
		$this->runValidation(new MaxValidator($this, ['field'=>'address2', 'display'=>'Alternative Address', 'errorField'=>'address2', 'rule'=>7]));
		$this->runValidation(new MaxValidator($this, ['field'=>'address', 'display'=>'Address', 'errorField'=>'address', 'rule'=>50]));
		$this->runValidation(new MaxValidator($this, ['field'=>'city', 'display'=>'City', 'errorField'=>'city', 'rule'=>50]));
		$this->runValidation(new MaxValidator($this, ['field'=>'state', 'display'=>'State', 'errorField'=>'state', 'rule'=>50]));
		$this->runValidation(new MaxValidator($this, ['field'=>'zip', 'display'=>'Zip Code', 'errorField'=>'zip', 'rule'=>7]));


		$this->runValidation(new NumericValidator($this, ['field'=>'home_phone', 'display'=>'Home Phone', 'errorField'=>'home_phone', 'rule'=>6]));
		$this->runValidation(new NumericValidator($this, ['field'=>'work_phone', 'display'=>'Work Phone', 'errorField'=>'work_phone', 'rule'=>6]));
		$this->runValidation(new NumericValidator($this, ['field'=>'cell_phone', 'display'=>'Cell Phone', 'errorField'=>'cell_phone', 'rule'=>6]));


		$this->runValidation(new RequiredValidator($this, ['field'=>'fname', 'display'=>'First Name', 'errorField'=>'fname']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'lname', 'display'=>'Last Name', 'errorField'=>'lname']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'email', 'display'=>'Email', 'errorField'=>'email']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'address', 'display'=>'Address', 'errorField'=>'address']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'city', 'display'=>'City', 'errorField'=>'city']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'state', 'display'=>'State', 'errorField'=>'state']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'zip', 'display'=>'Zip', 'errorField'=>'zip']));
	}


	public static function findAllByUserId($user_id, $params = []){
		$conditions = [
			'conditions' => ['user_id'],
			'bind' => [$user_id]
		];

		$conditions = array_merge($conditions, $params);
		return static::getDb()->find($conditions);
	}

	public static function findByIdAndUserId($id, $user_id, $params = []){
		$conditions = [
			'conditions' => ['id', 'user_id'],
			'bind' => [$id, $user_id]
		];

		$conditions = array_merge($conditions, $params);
		return static::getDb()->findFirst($conditions);
	}

	public function beforeSave(){
		$this->user_id = Users::currentUser()->id;
	}
}