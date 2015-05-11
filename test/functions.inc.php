<?php

function showTest($code) {

	$argv = func_get_args();

	$return = str_repeat('-', 80) . "\n";
	foreach($argv as $arg) {
		$return .= $arg . "\n";
	}
	$return .= str_repeat('-', 80) . "\n";
	echo $return;
}

$testCounter = 1;
