<?php
/**
 * Session Class [ Session.class.php ]
 *
 * @package    PHPClasses
 * @subpackage Core
 * @author     Eric Potvin
 * @link       https://github.com/ericpotvin/phpclasses
 */

/**
 * Session class
 * 
 * Session module class.
 * 
 * @package     PHPClasses
 * @subpackage  Session
 */
class Session extends Core {

	/**
	 * Const for default expired time
	 */
	const EXP_TIME = 28800;

	/**
	 * Session DB
	 *
	 * @var Object
	 */
	private $db;
	/**
	 * Session Id
	 *
	 * @var String
	 */
	private $sessionId;

	/**
	 * Session Constructor.
	 *
	 * @param Object $db    Database Handler object.
	 */
	public function __construct(&$db)
	{
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
	public function open($savePath, $sessName)
	{
		return TRUE;
	}

	/**
	 * Close a session.
	 *
	 */
	public function close()
	{
		return TRUE;
	}

	/**
	 * Check if the session is alive
	 *
	 * @return Bool
	 */
	public function isAlive($sid)
	{
		try {
			$rows = $this->db->prepare("SELECT `id` FROM `session` WHERE `id` = :sessionId");
			$rows->bindParam(':sessionId', $sid, PDO::PARAM_STR, 32);
			$rows->execute();
			$data = $rows->fetch(PDO::FETCH_ASSOC);
			return $data['id'] == $this->sessionId;
		}
		catch (PDOException $e) {
			$this->setMessage(1, $e->getMessage());
		}
	}

	/**
	 * Read the sessoin information.
	 *
	 * @return Array
	 */
	public function read($sid)
	{
		try {
			$rows = $this->db->prepare(
				"SELECT `data` FROM `session` WHERE `id` = :sessionId"
			);
			$rows->bindParam(':sessionId', $sid, PDO::PARAM_STR, 32);
			$result = $rows->execute();
			$data = $rows->fetch(PDO::FETCH_ASSOC);
			return $data['data'];
		}
		catch (PDOException $e) {
			$this->setMessage(1, $e->getMessage());
		}
	}

	/**
	 * Replace the sessions data.
	 *
	 * @param  Array  $data Session data.
	 * @return Boolean
	 */
	public function write($sid, $data)
	{
		$time = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
		try {
			$time = $time + self::EXP_TIME;
			$rows = $this->db->prepare(
				"REPLACE INTO `session` set `id` = :sessionId, `data` = :data,
				`expires` = FROM_UNIXTIME(:expires)"
			);
			$rows->bindParam(':sessionId', $sid, PDO::PARAM_STR, 32);
			$rows->bindParam(':data', $data, PDO::PARAM_LOB);
			$rows->bindParam(':expires', $time, PDO::PARAM_INT);
			return $rows->execute();
		}
		catch (PDOException $e) {
			$this->setMessage(1, $e->getMessage());
		}
	}

	/**
	 * Destroy a session.
	 *
	 * @return Boolean
	 */
	public function destroy($sid)
	{
		try {
			$rows = $this->db->prepare("DELETE FROM `session` WHERE `id` = :sessionId");
			$rows->bindParam(':sessionId', $sid, PDO::PARAM_STR, 32);
			return $rows->execute();
		}
		catch (PDOException $e) {
			$this->setMessage(1, $e->getMessage());
		}
	}

	/**
	 * Cleanup function removes expired sessions from the database.
	 *
	 * @return Boolean
	 */
	public function garbageCollector()
	{
		$time = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
		try {
			$time = $time + self::EXP_TIME;
			$rows = $this->db->prepare("DELETE FROM `session` WHERE `expires` < :time");
			$rows->bindParam(':time', $time);
			return $rows->execute();
		}
		catch (PDOException $e) {
			$this->setMessage(1, $e->getMessage());
		}
	}
}
