<?php

/**
 * Memory Class [ Memory.class.php ]
 *
 * @author      Eric Potvin
 * @package     PHPClasses
 * @subpackage  Memory
 * @link        https://github.com/BookOfZeus/php-classes
 */

if(!class_exists('Memcached')) {
	die('Unable to load module: Memcached');
}

/**
 * Memory class
 * 
 * Memory module class.
 * 
 * @package     PHPClasses
 * @subpackage  Memory
 */
class Memory extends Memcached {

	/**
	 * Core Constructor.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->addServer("127.0.0.1", 11211);
	}
}
