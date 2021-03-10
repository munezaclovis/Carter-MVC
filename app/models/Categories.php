<?php
namespace App\Models;
use Core\Model;
use Core\H;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;

/**
 * 
 */
class Categories extends Model
{
	public $id, $name, $deleted = 0;
	public const blackList = ["id", "deleted"];
	protected static $_table = 'categories';

	public static function getArray(){
		$result = [];
		$data = self::find();
		foreach ($data as $key) {
			$result[$key->id] = $key->name;
		}
		return $result;
	}

	public function validator(){

		$this->runValidation(new MinValidator($this, ['field'=>'name', 'display'=>'Category Name', 'errorField'=>'name', 'rule'=>1]));


		$this->runValidation(new MaxValidator($this, ['field'=>'name', 'display'=>'Category Name', 'errorField'=>'name', 'rule'=>255]));


		$this->runValidation(new RequiredValidator($this, ['field'=>'name', 'display'=>'Category Name', 'errorField'=>'name']));
	}
}