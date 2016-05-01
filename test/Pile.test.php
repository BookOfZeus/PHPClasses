<?php

require('../Pile.class.php');
require('functions.inc.php');

/** Tests **/

function test_isEmpty()
{
	$valid = 0;

	// Check empty first
	$pile = new Pile(10);
	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The list is empty", $nb == 0);

	return $valid;
}

function test_add()
{
	$valid = 0;

	// Check empty first
	$pile = new Pile(2);
	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The list is empty", $nb == 0);

	$pile->add(17);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 1 item", $nb == 1);

	$pile->add(170);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 2 item", $nb == 2);

	$pile->add(1700);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 2 item", $nb == 2);

	return $valid;
}

function test_remove()
{
	$valid = 0;

	// Check empty first
	$pile = new Pile(3);

	$pile->add(17);
	$pile->add(170);
	$pile->add(1700);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 2 item", $nb == 3);

	$pile->remove(1);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 1 item", $nb == 2);

	$pile->remove(10);

	$nb = $pile->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The pile has 0 item", $nb == 0);

	return $valid;
}

function getUnitTest()
{
	$id = 0;

	$list[$id++] = "test_isEmpty";
	$list[$id++] = "test_add";
	$list[$id++] = "test_remove";

	return $list;
}
