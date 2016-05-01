<?php
/**
 * User Class [ User.class.php ]
 *
 * @package    PHPClasses
 * @subpackage Core
 * @author     Eric Potvin
 * @link       https://github.com/ericpotvin/phpclasses
 */

/**
 * User class
 * 
 * User module class.
 * 
 * @package     PHPClasses
 * @subpackage  User
 */
class User extends Core {

	/**
	 * Session ID key
	 *
	 * @var String
	 */
	private $sessionIdKey;

	/**
	 * User Constructor.
	 *
	 * @param String $sessionIdKey The key of the _SESSION array.
	 * @param Object $db    Database Handler object.
	 */
	public function __construct($sessionIdKey)
	{
		$this->sessionIdKey = $sessionIdKey;
	}

	/**
	 * isLogged()
	 * Check if a user is logged in
	 *
	 * @return Boolean
	 */
	public function isLogged()
	{
		if(!isset($_SESSION[$this->sessionIdKey])) {
			return FALSE;
		}
		if(is_null($_SESSION[$this->sessionIdKey]) {
			return FALSE;
		}
		$Session = new Session(session_id());
		return $Session->isAlive();
	}

	/**
	 * logout()
	 * Logout a user
	 *
	 * @return Boolean
	 */
	public function logout()
	{
		$Session = new Session(session_id());
		return $Session->destroy();
	}

	/**
	 * validLogin()
	 * Check if the user/pass matches
	 *
	 * @param  String $user	Username
	 * @param  String $pass	The Encrypted Password
	 * @return Boolean
	 */
	public function validLogin($user, $pass)
	{
		$rows = $GLOBALS['dbc']->prepare(
			'SELECT `id` FROM `user` WHERE `username` = :username AND `password` = :pass'
		);
		$rows->bindParam(':username', $user, PDO::PARAM_STR, 200);
		$rows->bindParam(':pass', $pass, PDO::PARAM_STR, 255);
		$rows->execute();
		$data = $rows->fetch(PDO::FETCH_ASSOC);
		if(!is_array($data)) {
			return FALSE;
		}
		return $data;
	}

	/**
	 * updateUserPassword()
	 * Update the user password
	 *
	 * @param  String $user	Username
	 * @param  String $new 	The Encrypted Password
	 * @param  String $retype The re-typed Encrypted Password
	 * @return Boolean
	 */
	public function updateUserPassword($current, $new, $retype)
	{
		if($new !== $retype) {
			return FALSE;
		}
		$rows = $GLOBALS['dbc']->prepare(
			'UPDATE `user` SET `password` = :newpassWHERE `id` = :id AND `password` = :pass'
		);
		$rows->bindParam(':id', $_SESSION[$this->sessionIdKey], PDO::PARAM_STR, 200);
		$rows->bindParam(':pass', $current, PDO::PARAM_STR, 32);
		$rows->bindParam(':newpass', $new, PDO::PARAM_STR, 32);
		$rows->execute();
		return $rows->rowCount();
	}
}
