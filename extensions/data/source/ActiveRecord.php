<?php

namespace li3_activerecord\extensions\data\source;

use ActiveRecord\Config;
use lithium\util\String;

class ActiveRecord extends \lithium\data\source\Database {

	public function __construct(array $config=array()) {
		$cfg = Config::instance();
		$config = array_merge(array(
			'model_directory' => LITHIUM_APP_PATH . DIRECTORY_SEPARATOR . 'models',
			'driver' => 'MySql',
			'host' => '127.0.0.1',
			'login' => 'root',
			'password' => '',
			'database' => 'li3',
			'charset' => 'utf8',
			'cache' => false,
			'cache_expire' => 30
		), $config);
		$cfg->set_model_directory($config['model_directory']);
		$driver = $config['driver'] = strtolower($config['driver']);
		$connection = String::insert(
			$driver == 'sqlite' ?
				'sqlite://{:database}.db' :
				'{:driver}://{:login}:{:password}@{:host}/{:database}?charset={:charset}',
			$config
		);
		if ($config['cache']) {
			$options = array(
				'expire' => $config['cache_expire']
			);
			$cfg->set_cache($config['cache'], $options);
		}
		$cfg->set_connections(array('default' => $connection));
		$cfg->set_default_connection('default');
		parent::__construct($config);
	}

	public function connect() {}

	public function disconnect() {}

	public function entities($model=null) {}

	public function describe($entity, array $meta=array()) {}

	public function encoding($encoding=null) {}

	public function result($type, $resource, $context) {}

	public function error() {}

	protected function _execute($sql) {}

	protected function _insertId($query) {}

}

?>