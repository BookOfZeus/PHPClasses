<?php

require('../BaseCrypt.class.php');
require('functions.inc.php');

/** Tests **/

function test_getHash() {
	$valid = 0;

	$list = array(
		1 => 'cJio3',
		41 => 'L2d5z',
		733 => '1AjhT',
		82821 => 'C1VlT',
		467343 => 'rYWFN',
	);

	foreach($list as $k => $v) {
		$test = BaseCrypt::getHash($k);
		$valid += assertTrue(__FUNCTION__ . ": The key $k should be $v", $v == $test);
	}

	return $valid;
}

function getUnitTest() {
	$id = 0;

	$list[$id++] = "test_getHash";

	return $list;
}
