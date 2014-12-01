<?php

/**
 * Bitmask Class [ Bitmask.class.php ]
 *
 * @author      Eric Potvin
 * @package 	PHPClasses
 * @subpackage  Bitmask
 * @link        https://github.com/BookOfZeus/php-classes
 */

/**
 * Bitmask class
 * 
 * Bitmask module class.
 * 
 * @package     PHPClasses
 * @subpackage  Bitmask
 */
class Bitmask {

	/**
	 * Const for read permission
	 */
	const READ		= 1;
	/**
	 * Const for write permission
	 */
	const WRITE		= 2;
	/**
	 * Const for update permission
	 */
	const UPDATE	= 4;
	/**
	 * Const for delete permission
	 */
	const DELETE	= 8;

	/**
	 * Permission
	 *
	 * @var Integer
	 */
	private $permission;

	/**
	 * Core Constructor.
	 *
	 */
	public function __construct() {
		$this->permission = 0;
	}

	/**
	 * hasPermission()
	 * Check if has the permissions
	 *
	 * @param  Integer	$perm	Permission Constant
	 * @param  Boolean
	 */
	public function hasPermission($perm) {
		return ($this->permission & $perm) > 0;
	}

	/**
	 * set()
	 * Set the permission
	 *
	 * @param  Integer	$perm	Permission Constant
	 */
	public function set($perm) {
		$this->permission |= $perm;
	}

	/**
	 * revoke()
	 * Revoke a permission
	 *
	 * @param  Integer	$perm	Permission Constant
	 */
	public function revoke($perm) {
		$this->permission &= ~$perm;
	}

}
