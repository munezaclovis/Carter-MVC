<?php
	namespace App\Lib\Utilities;

	/**
	 * 
	 */
	class Uploads
	{

		private $_errors = [], $_files;
		private $_maxAllowedSize = 15728640;
		private $_allowedImageTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG];
		
		function __construct($files)
		{
			$this->_files = self::restructureFiles($files);
		}

		public function files(){
			return $this->_files;
		}

		public static function restructureFiles($files){
			$structured = [];
			foreach ($files['tmp_name'] as $key => $value) {
				$structured[] = [
					'tmp_name' => $files['tmp_name'][$key],
					'name' => $files['name'][$key],
					'size' => $files['size'][$key],
					'type' => $files['type'][$key],
					'error' => $files['error'][$key]
				];
			}
			return $structured;
		}

		public function validateSize(){
			foreach ($this->_files as $file) {
				if ($file['size'] > $this->_maxAllowedSize) {
					$msg = $name . 'was uploaded because it is over the max allowed size of ' . intval($this->_maxAllowedSize*0.00000095367432) . 'mb';
					$this->addErrorMessage($name, $msg);
				}
			}
		}

		public function validates(){
			return (empty($this->_errors))? true : $this->_errors;
		}

		public function upload($bucket, $name, $tmp){
			if (!is_dir($bucket)) {
				mkdir($bucket, 0777, true);
			}
			move_uploaded_file($tmp, $bucket . $name);
		}

		public function runValidation(){
			$this->validateSize();
			$this->validateImageType();
		}

		protected  function validateImageType(){
			$errors = [];
			foreach ($this->_files as $file) {
				if($file["error"] > 0){
					$this->addErrorMessage("empty", "no images were uploaded");
					break;
				}
				$name = $file['name'];
				if (!in_array(exif_imagetype($file['tmp_name']), $this->_allowedImageTypes)) {
					$msg = $name . ' was not uploaded because it is not an allowed image type. please use a jpeg or png';
					$this->addErrorMessage($name, $msg);
				}
			}
			
		}

		public function addErrorMessage($name, $message){
			if(array_key_exists($name, $this->_errors)){
				$this->_errors[$name] .= " " . $message;
			}else{
				$this->_errors[$name] = $message;
			}
		}
	}