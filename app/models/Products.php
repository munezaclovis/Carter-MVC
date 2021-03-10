<?php
namespace App\Models;
use Core\{Model, Session, Cookie, H};
use App\Models\{UserSessions, Images};
use Core\Validators\{RequiredValidator, NumericValidator, MinNumericValidator, MaxNumericValidator, DateValidator};

class Products extends Model{
	public $id, $name, $description, $barcode, $category, $price, $quantity, $date_added, $date_made, $date_expiry, $deleted = 0;
	const blackList = ["id", "deleted"];
    protected static $_table = 'products';


	public function afterDelete(){
		Images::unlink($this->id, $this->getTable());
	}

	public function afterSave(){
		$this->id = static::getDb()->lastInsertID();
	}

	public function validator(){
		$requiredFields = ["barcode" => "Barcode", "name" => "Name", "description"=> "Description", "category" => "Category", "price" => "Price", "quantity" => "Quantity", "date_added" => "Date Added", "date_made" => "Date Made", "date_expiry" => "Date Expiry"];

		foreach ($requiredFields as $field => $display) {
			$this->runValidation(new RequiredValidator($this, ['field'=>$field, 'errorField'=>$field, 'display'=>$display]));
		}

		$dateFields = ["date_added" => "Date Added", "date_made" => "Date Made", "date_expiry" => "Date Expiry"];

		foreach ($dateFields as $field => $display) {
			$this->runValidation(new DateValidator($this, ['field'=>$field, 'errorField'=>$field, 'display'=>$display]));
		}		

		$this->runValidation(new NumericValidator($this, ['field'=>'barcode', 'display'=>'Barcode', 'errorField'=>'barcode']));
		$this->runValidation(new NumericValidator($this, ['field'=>'quantity', 'display'=>'Quantity', 'errorField'=>'quantity']));
		$this->runValidation(new NumericValidator($this, ['field'=>'price', 'display'=>'Price', 'errorField'=>'price']));
	}
}