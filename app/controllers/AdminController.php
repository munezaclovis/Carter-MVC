<?php
namespace App\Controllers;
use App\Models\{Users, UserSessions, Products, Images, Categories};
use Core\{H, Session, Router, Controller};
use App\Lib\Utilities\Uploads;


class AdminController extends Controller{

	function __construct($controller, $method){
		parent::__construct($controller, $method);
		$this->view->setLayout('admin/default');
	}

	public function index(){
		$this->view->render("admin/index");
	}

	public function users($action = '', $id = ''){
		if($action == ''){
			$users = Users::find();
			$this->view->render("admin/users/index", ['users' => $users]);
		}elseif ($action == 'details' && $id != '') {
			$user = Users::findByID((int) $id);
			if ($user) {
				$this->view->render("admin/users/details", ['user' => $user]);
			}else{
				$this->view->render("restricted/admin/404.php");
			}
		}elseif($action == 'delete' && $id != ''){
			$user = Users::findByID((int) $id);
			if ($user) {
				$user->delete();
				Session::addMessage('success', 'User has been deleted');
				Router::redirect('admin/users');
			}
		}
	}

	public function products($action = '', $id = ''){
		if($action == ''){
			$products = Products::find();
			$this->view->render("admin/products/index", ['products' => $products]);
		}elseif ($action == 'details' && $id != '') {
			if ($this->request->isPost()) {
				$product = Products::findByID($this->request->get('id'));
				if (!$product) {
					$product = new Products();
				}
				$product->assign($this->request->get(), Products::$blackList);
				$this->request->csrfCheck();
				if($product->save()){
					Session::addMessage('success', 'Product has been Saved');
					Router::redirect('admin/products');
				}
			}
			$product = Products::findByID((int) $id);
			if ($product) {
				$this->view->render("admin/products/details", ['categories' => Categories::getArray(), 'product' => $product, 'errors'=>$product->getErrorMessages(), 'Post'=>PROOT . 'admin/products/details/'.$product->id]);
			}else{
				$this->view->render("restricted/admin/404.php");
			}
		}elseif($action == 'delete'){
			$id = $this->request->get('id');
			$product = Products::findByID((int) $id);
			$resp = [];
			if ($product) {
				$product->delete();
				$resp =  ['success' => true, 'msg' => "Product Deleted Successfully", 'model_id' => $id];
			}
			$this->jsonResponse($resp);
		}elseif($action == 'restore'){
			$id = $this->request->get('id');
			$product = Products::findByID((int) $id);
			$resp = [];
			if ($product) {
				$product->restore();
				$resp =  ['success' => true, 'msg' => "Product Restored Successfully", 'model_id' => $id];
			}
			$this->jsonResponse($resp);
		}elseif($action == 'add'){
			$product =  new Products();
			
			if ($this->request->isPost()) {
				$product->assign($this->request->get(), Products::blackList);
				
				$this->request->csrfCheck();
				$files = $_FILES['images'];
				$uploads = new Uploads($files);
				$uploads->runValidation();
				$imageErrors = $uploads->validates();

				if(is_array($imageErrors)){
					foreach ($imageErrors as $key => $value) {
						$product->addErrorMessage($key, "images", $value);
					}
				}
				if($product->save()){
					
					Images::uploadImage($product->id, $product->getTable(), $uploads);
					
					Session::addMessage('success', 'Product has been Saved');
					Router::redirect('admin/products');
				}
				
			}
			//$categories = new Categories();
			//$categories->find();
			//H::pnd(Categories::getArray());
			$this->view->render("admin/products/add", ['categories' => Categories::getArray(), 'product' => $product, 'errors'=>$product->getErrorMessages(), 'Post'=>PROOT . 'admin/products/add']);
		}
	}

	public function categories(){
		$this->view->render("admin/categories/index", ['categories' => Categories::find()]);
	}

	public function account(){
		$user = Users::currentUser();
		if ($this->request->isPost()) {
			$user->assign($this->request->get());
			
		}
		$this->view->render("admin/account/index", ['user'=>$user, 'errors'=>$user->getErrorMessages()]);
	}

	public function settings(){
		$this->view->render("admin/settings/index");
	}

	public function test(){
		if ($this->request->isPost()) {
			$files = Images::restructureFiles($_FILES['uploadField']);
			$images = new Images($files);
			$imageErrors = $images->validateImages();
			if($imageErrors){
				$images->uploadImages(1, 'products');
			}
		}
		$this->view->render("admin/test/index");
	}

	public function upload($type){
		if ($type == 'profile') {
			if ($this->request->isPost()) {
				if ($_FILES) {
					$config = ['folder' => ['images', 'users'], 'name' => 'profile'];
					$user = Users::currentUser();
					$newProfile = $user->upload($_FILES['profile'], $config);
					if ($newProfile) {
						$html = '<script>';
						$html .= '$(".img-profile").attr("src", "' . PROOT . '/images/users/' . $newProfile . '");';
						$html .= '</script>';
						echo $html;
					}else{
						echo "Internal server error";
					}

				}else{
					echo "No Files submitted!";
				}
			}
		}
	}
}