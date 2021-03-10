<?php
namespace App\Controllers;
use Core\{Controller, Router};
use App\Models\{Users, Login};
use Core\H;

/**
 * 
 */
class RegisterController extends Controller
{
	
	function __construct($controller, $method)
	{
		parent::__construct($controller, $method);
		$this->load_model('Users');
		$this->view->setLayout('default');
	}

	public function login(){
		$loginModel = new Login();
		if ($this->request->isPost()) {
			$this->request->csrfCheck();
			$loginModel->assign($this->request->get());
			$loginModel->validator();
			if ($loginModel->validationPassed()) {
				$user = $this->UsersModel->findByUsername($this->request->get('username'));
				if ($user && password_verify($loginModel->password, $user->password)) {
					$remember_me = $loginModel->getRememberMeChecked();
					$user->login($remember_me);
					Router::redirect('');
				}else{
					$loginModel->addErrorMessage('form', 'form','Username or Password does not match');
				}
			}
		}
		$this->view->render('register/login', ["errors" => $loginModel->getErrorMessages(), "login" => $loginModel]);
	}

	public function logout(){
		if(Users::currentUser()){
			Users::currentUser()->logout();
		}
		Router::redirect('register/login');
	}

	public function register(){
		$newUser = new Users();
		if ($this->request->isPost()) {
			$this->request->csrfCheck();
			$newUser->assign($this->request->get());
			$newUser->confirm = $this->request->get('confirm');
			if($newUser->save()){
				Router::redirect('register/login');
			}	
		}
		$this->view->render('register/register', ['errors'=> $newUser->getErrorMessages(), 'newUser'=>$newUser]);
	}
}