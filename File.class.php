<?php
/**
 * File Class [ File.class.php ]
 *
 * @package    PHPClasses
 * @subpackage File
 * @author     Eric Potvin
 * @link       https://github.com/ericpotvin/phpclasses
 */

/**
 * File class
 * 
 * File module class.
 * 
 * @package     PHPClasses
 * @subpackage  File
 */
class File {

	/**
	 * List of items
	 *
	 * @var Array
	 */
	private $list;
	/**
	 * Maximum of items
	 *
	 * @var Integer
	 */
	private $maxItems;

	/**
	 * Core Constructor.
	 *
	 * @param	Integer	$maxItems	Maximum number of items in the list
	 */
	public function __construct($maxItems)
	{
		$this->list = array();
		$this->maxItems = (int)abs($maxItems);
	}

	/**
	 * add()
	 * Add an item to the list
	 *
	 * @param	Mixed	$item	The item
	 * @return	Boolean
	 */
	public function add($item)
	{
		$totalItem = $this->getNumberItems();
		if($totalItem >= $this->maxItems) {
			return FALSE;
		}
		array_push($this->list, $item);
		return TRUE;
	}

	/**
	 * remove()
	 * Remove items from the list
	 *
	 * @param	Integer	$nb	Number of item to remove
	 * @return	Boolean
	 */
	public function remove($nb = 1)
	{
		$totalItem = $this->getNumberItems();
		if($totalItem == 0) {
			return FALSE;
		}
		$nb = min($totalItem, $nb);
		for($i = 0; $i < $nb; ++$i) {
			array_pop($this->list);
		}
		return TRUE;
	}

	/**
	 * get()
	 * Get the top element
	 *
	 * @return	Mixed
	 */
	public function get()
	{
		reset($this->list);
		$totalItem = $this->getNumberItems();
		if($totalItem == 0) {
			return FALSE;
		}
		return current($this->list);
	}

	/**
	 * getNumberItems()
	 * Get thte number of items in the list
	 *
	 * @return	Integer
	 */
	public function getNumberItems()
	{
		return count($this->list);
	}
}

