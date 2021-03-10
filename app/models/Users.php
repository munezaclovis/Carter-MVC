<?php
namespace App\Models;
use Core\{Model, Session, Cookie, H};
use App\Models\UserSessions;
use Core\Validators\{MinValidator, MaxValidator, EmailValidator, MatchesValidator, UniqueValidator, RequiredValidator};

/**
 * 
 */
class Users extends Model
{
	public $id, $fname, $lname, $email, $username, $password, $image,  $acl, $deleted = 0;
	const blackList = ["id", "deleted"];
	private $confirm;
	private $_isLoggedIn, $_sessionName, $_cookieName;
	public static $currentLoggedInUser = null;
	protected static $_table = 'users';
	

	public function __get($property){
		return $this->$property;
	}

	public function __set($property, $value){
		$this->$property = $value;
	}

	public static function findByUsername($username){
		return self::findFirst(['conditions' => ['username'], 'bind' => [$username]]);
	}

	public function login($rememberMe = false){
		Session::set(CURRENT_USER_SESSION_NAME, $this->id);
		if ($rememberMe) {
			$hash = md5(uniqid() + rand(0, 100));
			$user_agent = Session::user_agent_no_version();

			Cookie::set(REMEMBER_ME_COOKIE_NAME, $hash, REMEMBER_ME_COOKIE_EXPIRY);

			$fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
			static::getDb()->query("DELETE FROM `user_sessions` WHERE `user_id` = ? AND `user_agent` = ?", [$this->id, $user_agent]);
			static::getDb()->insert('user_sessions', $fields);
		}
	}

	public static function currentUser(){
		if (!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
			self::$currentLoggedInUser = self::findById((int) Session::get(CURRENT_USER_SESSION_NAME));
		}

		return self::$currentLoggedInUser;
	}

	public function logout(){
		$userSession = UserSessions::getFromCookie();
		if ($userSession) $userSession->delete();
		Session::delete(CURRENT_USER_SESSION_NAME);
		if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
			Cookie::delete(REMEMBER_ME_COOKIE_NAME);
		}
		self::$currentLoggedInUser = null;
		return true;
	}

	public static function loginUserFromCookie(){
		$userSession = UserSessions::getFromCookie();
		if ($userSession && $userSession->user_id != '') {
			$user = new self((int)$userSession->user_id);
			if ($user) {
				$user->login();
			}
			return $user;
		}
		return;
	}

	public function acls(){
		if (empty($this->acl)) return [];
		return json_decode($this->acl, true);
	}

	public static function addAcl($user_id,$acl){
		$user = self::findById($user_id);
		
		if(!$user) return false;
		
		$acls = $user->acls();
		
		if(!in_array($acl,$acls)){
			$acls[] = $acl;
			$user->acl = json_encode($acls);
			$user->save();
		}
		return true;
	}

	public static function removeAcl($user_id, $acl){
		$user = self::findById($user_id);
		
		if(!$user) return false;
		
		$acls = $user->acls();
		
		if(in_array($acl,$acls)){
			$key = array_search($acl,$acls);
			unset($acls[$key]);
			$user->acl = json_encode($acls);
			$user->save();
		}
		return true;
	}

	public function setConfirm($value){
		$this->confirm = $value;
	}

	public function getConfirm(){
		return $this->confirm;
	}

	public function beforeSave(){
		if ($this->isNew()) {
			$this->password = H::password_hash($this->password);
		}
		if (!$this->image || $this->image != '') {
			$this->image = DEFAULT_USER_IMAGE;
		}
	}

	public function validator(){

		$this->runValidation(new MinValidator($this, ['field'=>'username', 'errorField'=>'username', 'rule'=>6, 'display'=>'Username']));
		$this->runValidation(new MinValidator($this, ['field'=>'password', 'errorField'=>'password', 'rule'=>6, 'display'=>'Password']));


		$this->runValidation(new MaxValidator($this, ['field'=>'username', 'errorField'=>'username', 'rule'=>25, 'display'=>'Username']));
		$this->runValidation(new MaxValidator($this, ['field'=>'password', 'errorField'=>'password', 'rule'=>150, 'display'=>'Password']));


		$this->runValidation(new EmailValidator($this, ['field'=>'email', 'errorField'=>'email', 'display'=>'Email']));

		
		
		if ($this->isNew()) {
			$this->runValidation(new MatchesValidator($this, ['field'=>'confirm', 'errorField'=>'confirm', 'rule' => $this->password, 'display'=>'Passwords']));
		}


		$this->runValidation(new UniqueValidator($this, ['field'=>'username', 'errorField'=>'username', 'display'=>'Username']));
		$this->runValidation(new UniqueValidator($this, ['field'=>'email', 'errorField'=>'email', 'display'=>'Email']));


		$this->runValidation(new RequiredValidator($this, ['field'=>'username', 'errorField'=>'username', 'display'=>'Username']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'email', 'errorField'=>'email', 'display'=>'Email']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'password', 'errorField'=>'password', 'display'=>'Password']));
		$this->runValidation(new RequiredValidator($this, ['field'=>'confirm', 'errorField'=>'confirm', 'display'=>'Confirm']));
	}
}