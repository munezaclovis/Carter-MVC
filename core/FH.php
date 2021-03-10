<?php
namespace Core;
use Core\{Session, H};

class FH
{

	public static function inputTextBox($type, $label, $name, $value='', $inputAttrs = [], $divAttrs = []){
		$divString = self::AttrsToString($divAttrs);
		$inputString = self::AttrsToString($inputAttrs);
		$html = '<div' . $divString . '>';
		$html .= '<label for="' . $name . '">' . $label . '<div id="'.ucwords($name).'Error" class="error"></div></label>';
		$html .= '<input type="' . $type . '" name="' . $name . '" value="' . $value . '"' . $inputString . ' />';
		$html .= '</div>';
		$html .= '<div class="pt-0"></div>';
		return $html;
	}

	public static function selectBox($label, $name, $options, $selectAttrs = [], $divAttrs = []){
		$selectAttrs["class"] .= " selectpicker";
		$divString = self::AttrsToString($divAttrs);
		$selectString = self::AttrsToString($selectAttrs);
		$html = '<div' . $divString . '>';
		$html .= '<label for="' . $name . '">' . $label . '<div id="'.ucwords($name).'Error" class="error"></div></label>';
		$html .= '<select name="' . $name . '" ' . $selectString . ' data-live-search="true">';
		if(!empty($options[0])){
			foreach ($options[0] as $key => $value) {
				if($options[1] == $key){
					$html .= '<option selected value="' . $key . '"> ' . $value . ' </option>';
				}else{
					$html .= '<option value="' . $key . '"> ' . $value . ' </option>';
				}
			}
		}else{
			$html .= '<option value="Default"> Default </option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '<div class="pt-0"></div>';
		return $html;
	}

	public static function fileInput($label, $name, $inputAttrs = [], $divAttrs = [], $oninput = ""){
		$divString = self::AttrsToString($divAttrs);
		$inputString = self::AttrsToString($inputAttrs);
		$html = '<div' . $divString . '>';
		$html .= '<label for="' . $name . '">' . $label . '<div id="'.ucwords($name).'Error" class="error"></div></label>';
		$html .= '<input type="file" id="' . $name . '" name="' . $name . '[]" ' . $inputString . ' oninput="' . $oninput . '(this)" />';
		$html .= '</div>';
		$html .= '<div class="pt-0"></div>';
		return $html;
	}

	public static function imageGallery($uploadField, $divAttrs){
		$divString = self::AttrsToString($divAttrs);
		$html = '<div ' . $divString . '>';
		$html .= '<div class="gallery">';
		$html .= '<div class="gallery-preview p-5" id="gallery-preview">';
		$html .= '</div>';
		$html .= '<div class="d-flex w-100">';
		$html .= '<button type="button" class="btn rounded-bottom center gallery-btn w-100" id="uploadBtn">';
		$html .= '<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
		$html .= '<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>';
		$html .= '</svg>';
		$html .= '</button>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<script type="text/javascript">';
		$html .= '$("#uploadBtn").click(function(){ $("#' . $uploadField . '").trigger("click"); });';
		$html .= '</script>';
		return $html;
	}

	public static function inputButton($buttonText, $btnAttrs=[], $divAttrs=[], $reset = false){
		$divString = self::AttrsToString($divAttrs);
		$btnString = self::AttrsToString($btnAttrs);

		$html = '<div' . $divString . '>';
		if ($reset == true) {
			$html .= '<div class="d-flex justify-content-center">';
	    	$html .= '<button type="button" class="btn btn-reset" onclick="goBack()">Go Back</button>';
			$html .= '<div class="px-2"></div>';
			$html .='<input type="submit" value="'.$buttonText.'"'.$btnString.'>';
	    	$html .= '</div>';
		}else{
			$html .='<input type="submit" value="'.$buttonText.'"'.$btnString.'>';
		}
	    
	    $html .='</div>';
	    return $html;
	}

	public static function textArea($label, $name, $value, $inputAttrs = [], $divAttrs = []){
		$divString = self::AttrsToString($divAttrs);
		$inputString = self::AttrsToString($inputAttrs);

		$html = '<div' . $divString . '>';
		$html .= '<label for="' . $name . '">' . $label . '</label>';
		$html .= '<textarea id="' . $name . '" name="' . $name . '" ' . $inputString . ' >' . $value . '</textarea>';
		$html .= '</div>';
		return $html;
		
	}

	public static function resetButton($buttonText = "Reset"){
		$html = '<div>';
	    $html .='<input type="reset" value="'.$buttonText.'">';
	    $html .='</div>';
	    return $html;
	}

	public static function inputCheckBox($label, $name,$labelAttrs = [], $inputAttrs = [], $subDivAttrs = [], $divAttrs = []){
		$divString = self::AttrsToString($divAttrs);
		$subDivString = self::AttrsToString($subDivAttrs);
		$labelString = self::AttrsToString($labelAttrs);
		$inputString = self::AttrsToString($inputAttrs);
		$html = '<div' . $divString . '>';
		$html .= '<div' . $subDivString . '>';
		$html .= '<input type="checkbox" name="' . $name . '" ' . $inputString . ' />';
		$html .= '<label for="' . $name . '" '.$labelString.'>' . $label . '</label>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	public static function AttrsToString($attrs){

		$string = '';
		foreach ($attrs as $key => $value) {
			$string .= ' ' . $key . '="' . $value . '"';
		}
		return $string;
	}

	public static function generateToken(){
		$token = bin2hex(random_bytes(32));
		Session::set('csrf_token', $token);
		return $token;
	}

	public static function checkToken($token){
		return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
	}

	public static function csrfInput(){
		return '<input type="hidden" name="csrf_token" id="csrf_token" value="' . self::generateToken() . '">';
	}

	public static function sanitize($dirty){
		return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
	}

	public static function posted_values($post){
		$clean_array = [];
		foreach ($post as $key => $value) {
			$clean_array[$key] = self::sanitize($value);
		}
		return $clean_array;
	}

	public static function displayErrors($errors){
		$html = '
		<script>
			$("document").ready(function(){';
		foreach ($errors as $field => $error) {
			if(mb_strtolower($error['errorField']) == "form"){
				$div_id = ucwords($error['errorField']) . 'Error';
				$html .= '
					$("#' . $div_id . '").text("' . $error["msg"] . '");
					$("#' . $div_id . '").addClass("error text-center alert alert-danger");
				';
			}else {
				$div_id = ucwords($error['errorField']) . 'Error';
				$html .= '
					$("#' . $div_id . '").text("' . $error["msg"] . '");
					$("#' . $div_id . '").addClass("error");
					$("[name=' . $field . ']").addClass("border border-danger");
				';
			}
		}

		$html .= '});
		</script>
		';
		return($html);
	}
}