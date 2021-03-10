<?php
namespace Core;

class Upload{

	public static function save($files, $config = []){
		if (!empty($files)) {
			if (!array_key_exists('folder', $config)) {
				return false;
			}elseif (!array_key_exists('name', $config)) {
				$config['name'] = '';
			}

			if (!is_string($config['name'])) {
				return false;
			}

			if (is_array($config['folder'])) {
				$folder = implode(DS, $config['folder']) . DS;
			}else{
				$folder = $config['folder'];
			}

			$fileExt = explode('/', $files['type'])[1];
			$fileName = uniqid($config['name'] . '_') . '.' . $fileExt;
			$filePath = ROOT . DS . $folder . $fileName;
			move_uploaded_file($files['tmp_name'], $filePath);
			return $fileName;
		}else{
			return false;
		}
	}
}