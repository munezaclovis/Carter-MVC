<?php

define('PROOT', '/mvc/');//set this to / if it is on a live server
define('DEBUG', true);

define('DB_NAME', 'mvc');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');

//default controller
define('DEFAULT_CONTROLLER', 'Home');

define('DEFAULT_METHOD', 'index');

define('IMAGE_UPLOAD_FOLDER', 'uploads' . DS . 'images' . DS);

//default layout
define('DEFAULT_LAYOUT', 'default');

//site title
define('SITE_TITLE', 'Clovis MVC Framework');

//copyright
define('COPYRIGHT', 'Clovis Muneza');



define('LOGO', PROOT . DS . 'images' . DS . 'logo.png');

define('CURRENT_USER_SESSION_NAME', 'kASksdhoSADhoanhgASOGFDia');//session name for logged in user
define('REMEMBER_ME_COOKIE_NAME', 'MASuasdoSDnpYAvPXAq');//cookie name for logged in user
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);//time in seconds for remember me cokie
define('ACCESS_RESTRICTED', 'restricted');//controller name for the restricted redirect
define('DEFAULT_USER_IMAGE', 'user.svg');
