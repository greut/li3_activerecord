<?php

namespace li3_activerecord\extensions\analysis;

/**
 * Wraps `lithium\analysis\Logger` into a `Pear::Log` compatible interface
 *
 * @see lithium\analysis\Logger
 * @see http://pear.php.net/package/Log
 */
class Log extends \lithium\core\Object
{
	/**
	 * List of classes to be used, can be overriden during init
	 *
	 * @see lithium\core\Object::_init
	 */
	protected $_classes = array(
		'logger' => 'lithium\\analysis\\Logger'
	);
	/**
	 * autoConfig used by lithium
	 *
	 * @see lithium\core\Object::_autoConfig
	 */
	protected $_autoConfig = array('classes' => 'merge');

	/**
	 * PHP AR will check for a `log` method to exists and because li3 doesn't
	 * have it, it'll be redirected to `info` instead.
	 */
	public function log()
	{
		$this->__call('info', func_get_args());
	}

	/**
	 * Handles all the logging needs to the defined logger.
	 *
	 * @see li3_activerecord\extensions\analysis\Log::_classes
	 */
	public function __call($method, $args)
	{
		return call_user_func_array(array($this->_classes['logger'], $method), $args);
	}
}