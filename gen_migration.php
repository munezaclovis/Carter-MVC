<?php
  if (php_sapi_name() != 'cli') die('Restricted');
  define('DS', DIRECTORY_SEPARATOR);
  define('ROOT', dirname(__FILE__));

  if (!is_dir(ROOT . DS . 'migrations')) {
    mkdir(ROOT . DS . 'migrations', 0777, true);
  }

  $fileName = "Migration".time();
  $ext = ".php";
  $fullPath = ROOT.DS.'migrations'.DS.$fileName.$ext;
  $content = '<?php
  namespace Migrations;
  use Core\Migration;

  class '.$fileName.' extends Migration {
    public function up() {

    }
  }
  ';
  $resp = file_put_contents($fullPath,$content);
