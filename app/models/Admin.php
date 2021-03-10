<?php
namespace App\Models;
use Core\Model;
use Core\Cookie;
use Core\Session;
use Core\H;
use App\Models\UserSessions;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;
use Core\Validators\RequiredValidator;

class Admin extends Model{
	
}