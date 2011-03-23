<?php

namespace li3_activerecord\extensions\analysis;

class Log extends \lithium\core\Object
{
	protected $_classes = array(
		'logger' => 'lithium\\analysis\\Logger'
	);

	public function log()
	{
		$this->__call('info', func_get_args());	
	}

	public function __call($method, $args)
	{
		return call_user_func_array(array($this->_classes['logger'], $method), $args);
	}
}