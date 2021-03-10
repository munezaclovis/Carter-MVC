<?php
namespace App\Controllers;
use Core\{Controller, Session, Router, H};
use App\Models\Contacts;
use App\Models\Users;

class ContactsController extends Controller{

	function __construct($controller, $method){
		parent::__construct($controller, $method);
		$this->load_model('Contacts');
		$this->view->setLayout('default');
	}

	public function index(){
		$contacts = $this->ContactsModel->findAllByUserId(Users::currentUser()->id, ['order'=>'lname, fname']);
	    $this->view->render('contacts/index',['contacts'=>$contacts]);
	}

	public function add(){
		$contact = new Contacts();
		if ($this->request->isPost()) {
			$contact->assign($this->request->get());
			$this->request->csrfCheck();
			if($contact->save()){
				Session::addMessage('success', 'Contact has been added');
				Router::redirect('contacts');
			}
		}
		$this->view->render("contacts/add_contact",['contact'=>$contact,'Post'=>PROOT . 'contacts' . DS . 'add', 'errors'=>$contact->getErrorMessages()]);
	}

	public function details($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

		if (!$contact) {
			Router::redirect('contacts');
		}
		$this->view->render("contacts/details", ['contact' => $contact]);
	}

	public function delete($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
		if($contact)
			$contact->delete();
			Session::addMessage('success', 'Contact has been deleted');
		
		Router::redirect('contacts');
	}

	public function edit($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

		if (!$contact) {
			Router::redirect('contacts');
		}

		if ($this->request->isPost()) {
			$contact->assign($this->request->get());
			$this->request->csrfCheck();
			if($contact->save()){
				Session::addMessage('success', 'Contact has been updated');
				Router::redirect('contacts');
			}
		}

		$this->view->render("contacts/edit", ['Post' => PROOT . 'contacts' . DS . 'edit' . DS . $contact->id, 'errors' => $contact->getErrorMessages(), 'contact' => $contact]);
	}

}