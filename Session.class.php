<?php

/**
 * Session Class [ Session.class.php ]
 *
 * @author      Eric Potvin
 * @package     PHPClasses
 * @subpackage  Core
 * @link        https://github.com/BookOfZeus/php-classes
 *
 */

/**
 * Session class
 * 
 * Session module class.
 * 
 * @package     PHPClasses
 * @subpackage  Session
 */
class Session {

	/**
	 * Error message;
	 *
	 * @var Mixed
	 */
	private $error;    

	/**
	 * Database handler.
	 *
	 * @var Object
	 */
	private $db;

	/**
	 * Session Constructor.
	 *
	 * @param Object $db    Database Handler object.
	 */
	function __construct(&$db) {
		$this->error = '';
		$this->db = $db;
		session_set_save_handler(
			array(&$this, "open"),
			array(&$this, "close"),
			array(&$this, "read"),
			array(&$this, "write"),
			array(&$this, "destroy"),
			array(&$this, "garbageCollector")
		);
		session_start();
	}

	/**
	 * Open the session handler.
	 * 
	 * @param  String $savePath  Save path.
	 * @param  String $sessName  Session Name.
	 * @return Boolean
	 */
	public function open($savePath, $sessName) {
		return TRUE;
	}

	/**
	 * Close a session.
	 *
	 */
	public function close() {
		return TRUE;
	}

	/**
	 * Check if the session is alive
	 *
	 * @param  String $sessionId   Session Id.
	 * @return Bool
	 */
	public function isAlive($sessionId) {
		try {
			$rows = $this->db->prepare("SELECT `id` FROM `session`.`session` WHERE `id` = :sessionId");
			$rows->bindParam(':sessionId', $sessionId, PDO::PARAM_STR, 32);
			$rows->execute();
			$data = $rows->fetch(PDO::FETCH_ASSOC);
			return $data['id'] == $sessionId;            
		}
		catch (PDOException $e) {
			$this->error = $e;
		}
	}

	/**
	 * Read the sessoin information.
	 *
	 * @param  String $sessionId   Session Id.
	 * @return Array
	 */
	public function read($sessionId) {
		try {
			$rows = $this->db->prepare("SELECT `data` FROM `session`.`session` WHERE `id` = :sessionId");
			$rows->bindParam(':sessionId', $sessionId, PDO::PARAM_STR, 32);
			$rows->execute();
			$data = $rows->fetch(PDO::FETCH_ASSOC);
			return $data['data'];            
		}
		catch (PDOException $e) {
			$this->error = $e;
		}
	}

	/**
	 * Replace the sessions data.
	 *
	 * @param  String $sessionId   Session Id.
	 * @param  Array  $sessData Session data.
	 * @return Boolean
	 */
	public function write($sessionId, $sessData) {
		$time = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
		try {
			$expTime = $time + 28800; // 60 * 60 * 8
			$rows = $this->db->prepare("REPLACE INTO `session`.`session` set `id` = :sessionId, `data` = :data, `expires` = :date");
			$rows->bindParam(':sessionId', $sessionId, PDO::PARAM_STR, 32);
			$rows->bindParam(':data', $sessData, PDO::PARAM_LOB);
			$rows->bindParam(':date', $expTime, PDO::PARAM_STR, 20);
			return $rows->execute();
		}
		catch (PDOException $e) {
			$this->error = $e;
		}
	}

	/**
	 * Destroy a session.
	 *
	 * @param  String $sessionId   Session Id.
	 * @return Boolean
	 */
	public function destroy($sessionId) {
		try {
			$rows = $this->db->prepare("DELETE FROM `session`.`session` WHERE `id` = :sessionId");
			$rows->bindParam(':sessionId', $sessionId, PDO::PARAM_STR, 32);
			return $rows->execute();
		}
		catch (PDOException $e) {
			$this->error = $e;
		}
	}

	/**
	 * Cleanup function removes expired sessions from the database.
	 *
	 * @return Boolean
	 */
	public function garbageCollector() {
		return TRUE;
	}

	/**
	 * Cleanup function removes expired sessions from the database.
	 *
	 * @param Object $timestamp Timestamp.
	 * @return Mixed
	 */
	public static function clearSession($timestamp) {
		try {
			$rows = $this->db->prepare("DELETE FROM `session`.`session` WHERE `expires` < :time");
			$rows->bindParam(':time', $timestamp);
			return $rows->execute();
		}
		catch (PDOException $e) {
			return $e;
		}
	}
}
