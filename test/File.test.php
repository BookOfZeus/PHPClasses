<?php

require('../File.class.php');
require('functions.inc.php');

/** Tests **/

function test_isEmpty()
{
	$valid = 0;

	// Check empty first
	$file = new File(10);
	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The list is empty", $nb == 0);

	return $valid;
}

function test_add()
{
	$valid = 0;

	// Check empty first
	$file = new File(2);
	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The list is empty", $nb == 0);

	$file->add(17);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 1 item", $nb == 1);

	$file->add(170);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 2 item", $nb == 2);

	$file->add(1700);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 2 item", $nb == 2);

	return $valid;
}

function test_remove()
{
	$valid = 0;

	// Check empty first
	$file = new File(3);

	$file->add(17);
	$file->add(170);
	$file->add(1700);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 2 item", $nb == 3);

	$file->remove(1);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 1 item", $nb == 2);

	$file->remove(10);

	$nb = $file->getNumberItems();
	$valid += assertTrue(__FUNCTION__ . ": The file has 0 item", $nb == 0);

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
