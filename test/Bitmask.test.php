<?php

require('../Bitmask.class.php');
require('functions.inc.php');

/** Tests **/

function test_read() {
	$valid = 0;

	$bitmask = new Bitmask();
	$bitmask->set(Bitmask::READ);

	$result = $bitmask->hasPermission(Bitmask::READ);
	$valid += assertTrue(__FUNCTION__ . ": Should have read permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::WRITE);
	$valid += assertTrue(__FUNCTION__ . ": Should NOT have write permissions", $result === FALSE);

	return $valid;
}

function test_readWrite() {
	$valid = 0;

	$bitmask = new Bitmask();
	$bitmask->set(Bitmask::READ | Bitmask::WRITE);

	$result = $bitmask->hasPermission(Bitmask::READ);
	$valid += assertTrue(__FUNCTION__ . ": Should have read permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::WRITE);
	$valid += assertTrue(__FUNCTION__ . ": Should have write permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::READ | Bitmask::WRITE);
	$valid += assertTrue(__FUNCTION__ . ": Should have read/write permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::UPDATE);
	$valid += assertTrue(__FUNCTION__ . ": Should NOT have update permissions", $result === FALSE);

	return $valid;
}

function test_revoke() {
	$valid = 0;

	$bitmask = new Bitmask();
	$bitmask->set(Bitmask::READ | Bitmask::WRITE);

	$result = $bitmask->hasPermission(Bitmask::READ);
	$valid += assertTrue(__FUNCTION__ . ": Should have read permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::WRITE);
	$valid += assertTrue(__FUNCTION__ . ": Should have write permissions", $result === TRUE);

	$bitmask->revoke(Bitmask::WRITE);

	$result = $bitmask->hasPermission(Bitmask::READ);
	$valid += assertTrue(__FUNCTION__ . ": Should have read permissions", $result === TRUE);

	$result = $bitmask->hasPermission(Bitmask::WRITE);
	$valid += assertTrue(__FUNCTION__ . ": Should POT have write permissions", $result === FALSE);

	return $valid;
}

function getUnitTest() {
	$id = 0;

	$list[$id++] = "test_read";
	$list[$id++] = "test_readWrite";
	$list[$id++] = "test_revoke";

	return $list;
}
