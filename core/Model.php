<?php

namespace Core;
use Core\Upload;


class Model
{
	protected $_modelName, $_validates = true,$_validationErrors = [];
	public $id;
	protected static $_db, $_table, $_softDelete = false;

	public function __construct() {
		$this->_modelName = str_replace(' ', '', ucwords(str_replace('_',' ', static::$_table)));
		$this->onConstruct();
	}

	public static function getDb(){
		if(!self::$_db) {
		  self::$_db = DB::getInstance();
		}
		return self::$_db;
	}


	public static function get_columns() {
	    return static::getDb()->get_columns(static::$_table);
	  }

	public function getTable(){
		return static::$_table;
	}

	public static function find($params = []){
		$params = self::_softDeleteParams($params);
		$results = [];
		$resultsQuery = static::getDb()->find(static::$_table, $params, static::class);
		return $resultsQuery;
	}

	public static function findFirst($params = []){
		$params = static::_softDeleteParams($params);
		$resultsQuery = static::getDb()->findFirst(static::$_table, $params, static::class);
		return $resultsQuery;
	}

	public static function findByID($id){
		return static::findFirst(['conditions'=>['id'], 'bind'=>[$id]]);
	}

	public function save(){
		$this->validator();
		if ($this->_validates) {
			$this->beforeSave();
			$fields = H::getObjectProperties($this);
			//determine whether to update or insert
			if($this->isNew()){
				$save = $this->insert($fields);
				$this->afterSave();
				return $save;
			}else{
				$save = $this->update($fields);
				$this->afterSave();
				return $save;
			}
		}
		return false;
	}

	public function insert($fields){
		if(empty($fields)) return false;
		return static::getDb()->insert(static::$_table, $fields);
	}

	public function update($fields){
		if(empty($fields) || empty($this->id)) return false;

		return static::getDb()->update(static::$_table, $this->id, $fields);
	}

	public function delete($id = ''){
		if ($id == '' && $this->id == '') return false;
		$id = ($id == '')? $this->id : $id;

		if ($this->beforeDelete()){
			// if (static::$_softDelete) {
			// 	$delete = static::getDb()->update(static::$_table, $id, ['deleted' => 1]);
			// }else{
			// 	$delete = static::getDb()->delete(static::$_table, $id);
			// }
			$delete = static::getDb()->update(static::$_table, $id, ['deleted' => 1]);
			if ($delete) {
				$this->afterDelete();
			}
		}else{
			$delete = false;
		}
		return $delete;
	}

	public function restore(){
		if(empty($this->id)) return false;

		return static::getDb()->update(static::$_table, $this->id, ['deleted' => 0]);
	}

	protected static function _softDeleteParams($params){
		if (property_exists(static::class, 'deleted')) {
			if (static::$_softDelete) {
				if (array_key_exists('conditions', $params)) {
					$params['conditions'][] = 'deleted';
					$params['bind'][] = 0;
				}else{
					$params['conditions'] = ["deleted"];
					$params['bind'] = [0];
				}
			}
		}
		return $params;
	}

	public function query($sql, $bind = []){
		return static::getDb()->query($sql, $bind);
	}

	public function data(){
		$data = new \stdClass();
		foreach (H::getObjectProperties($this) as $column => $value) {
			$data->$column = $value;
		}
		return $data;
	}

	public function assign($params, $list = [], $blackList = true){		
		if (!empty($params)) {
			foreach ($params as $key => $value) {
				$whiteListed = true;
				if(sizeof($list) > 0){
					if($blackList){
						$whiteListed = !in_array($key,$list);
					} else {
						$whiteListed = in_array($key,$list);
					}
				}

				if(property_exists($this,$key) && $whiteListed){
					//$obj = new \ReflectionProperty($this,$key);
					//if(!$obj->isPrivate() && !$obj->isProtected()){
						$this->$key = $value;
					//}
				}
			}
		}
	}

	protected function populateObjData($result){
		foreach ($result as $key => $value) {
			$this->$key = $value;
		}
	}

	public function validator(){}

	public function runValidation($validator){
		$key = $validator->field;

		if (!$validator->success) {
			$this->_validates = false;
			$this->_validationErrors[$key]['msg'] = $validator->msg;
			$this->_validationErrors[$key]['errorField'] = $validator->errorField;
		}
	}
	
	public function getErrorMessages(){
		return $this->_validationErrors;
	}

	public function validationPassed(){
		return $this->_validates;
	}

	public function addErrorMessage($field, $errorField, $msg){
		$this->_validates = false;
		$this->_validationErrors[$field]['msg'] = $msg;
		$this->_validationErrors[$field]['errorField'] = $errorField;
	}

	public function isNew(){
		return (property_exists($this, 'id') && !empty($this->id)) ? false : true;
	}


	public function upload($files, $config){
		$upload = Upload::save($files, $config);
		if ($upload) {
			$save = $this->update($this->id, ['image' => $upload]);
			return $upload;
		}else{
			return false;
		}
	}

	public function onConstruct(){}
	public function beforeSave(){}
	public function afterSave(){}
	public function beforeDelete(){return true;}
	public function afterDelete(){}
}