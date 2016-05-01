<?php
/**
 * Core Class [ Core.class.php ]
 *
 * @package    PHPClasses
 * @subpackage Core
 * @author     Eric Potvin
 * @link       https://github.com/ericpotvin/phpclasses
 */

/**
 * Core class
 * 
 * Core module class.
 * 
 * @package     PHPClasses
 * @subpackage  Core
 */
abstract class Core {

	/**
	 * Const for JSON format
	 */
	const FORMAT_JSON = 0;

	/**
	 * Const for XML format
	 */
	const FORMAT_XML = 1;

	/**
	 * Error Number
	 *
	 * @var Integer
	 */
	private $errorId = 0;

	/**
	 * Error Message
	 *
	 * @var String
	 */
	private $errorMsg = NULL;

	//
	// Class Methods
	//

	/**
	 * Core Constructor.
	 *
	 */
	public function __construct()
	{
	}

	/**
	 * Core Destructor
	 *
	 */
	public function __destruct()
	{
	}

	//
	// Errors Methods
	//

	/**
	 * setMessage()
	 * Set the error message
	 *
	 * @param  Integer	$no		Error Number
	 * @param  String	$msg	Message
	 */
	public function setMessage($no, $msg)
	{
		$this->errorId = (int)$no;
		$this->errorMsg = $msg;
	}

	/**
	 * getErrorId()
	 * Get the error number
	 *
	 * @return	Integer
	 */
	public function getErrorId()
	{
		return $this->errorId;
	}

	/**
	 * getErrorMsg()
	 * Get the error message
	 *
	 * @return	String
	 */
	public function getErrorMsg()
	{
		return $this->errorMsg;
	}

	/**
	 * getFormatedError()
	 * Get the error in a JSON or XML format
	 *
	 * @param	String	$mode	
	 * @return	String
	 */
	public function getFormatedError($mode = Core::FORMAT_JSON)
	{
		$data = array(
			'error' => $this->errorId,
			'message' => $this->errorMsg
		);
		if($mode === Core::FORMAT_XML) {
			$xml = new SimpleXMLElement('<result/>');
			array_walk_recursive(array_flip($data), array ($xml, 'addChild'));
			return $xml->asXML();
		}
		return json_encode($data);
	}

}
