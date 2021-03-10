<?php
namespace App\Models;
use Core\{Model, H};

class Images extends Model{
	public $id, $folder, $item_id, $url, $deleted = 0;
	protected static $_table = "images";
	

	public static function uploadImage($id, $folder, $uploads){
		$path = IMAGE_UPLOAD_FOLDER . $folder . DS . $id . DS;

		foreach ($uploads->files() as $file) {
			$parts = explode('.', $file['name']);
			$ext = end($parts);
			$hash = sha1(time() . $id . $file['tmp_name']);
			$uploadName = $hash . '.' . $ext;
			$image = new self();
			$image->folder = $folder;
			$image->item_id = $id;
			$image->url = PROOT . $path . $uploadName;
			if ($image->save()) {
				$uploads->upload($path, $uploadName, $file['tmp_name']);
			}
		}
	}

	public static function unlink($item_id, $folder){
		$images = self::find([
			'conditions' => ["item_id", "folder"],
			'bind' => [$item_id, $folder]
		]);

		if(!empty($images)){
			foreach ($images as $image) {
				$image->update(["item_id" => "0"]);
			}
		}
	}
}