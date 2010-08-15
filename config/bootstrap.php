<?php

use \lithium\core\Libraries;

use ActiveRecord\Config;

if (!defined('ACTIVERECORD_LIB_PATH')) {
	define('ACTIVERECORD_LIB_PATH', LITHIUM_LIBRARY_PATH . '/activerecord/lib');
}

require ACTIVERECORD_LIB_PATH . '/Singleton.php';
require ACTIVERECORD_LIB_PATH . '/Config.php';
require ACTIVERECORD_LIB_PATH . '/Utils.php';
require ACTIVERECORD_LIB_PATH . '/DateTime.php';
require ACTIVERECORD_LIB_PATH . '/Model.php';
require ACTIVERECORD_LIB_PATH . '/Table.php';
require ACTIVERECORD_LIB_PATH . '/ConnectionManager.php';
require ACTIVERECORD_LIB_PATH . '/Connection.php';
require ACTIVERECORD_LIB_PATH . '/SQLBuilder.php';
require ACTIVERECORD_LIB_PATH . '/Reflections.php';
require ACTIVERECORD_LIB_PATH . '/Inflector.php';
require ACTIVERECORD_LIB_PATH . '/CallBack.php';
require ACTIVERECORD_LIB_PATH . '/Exceptions.php';
require ACTIVERECORD_LIB_PATH . '/Cache.php';

$name = 'activerecord';
$library = Libraries::get($name);

if (empty($library)) {
	Libraries::add($name, array(
		'bootstrap' => false, 
		'path' => ACTIVERECORD_LIB_PATH,
		'prefix' => 'ActiveRecord'
	));
}

?>