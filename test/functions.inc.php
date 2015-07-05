<?php

/**
 * Define the Unit Tests
 */

$testRan = 0;

/**
 * Define the tests
 */
function assertTrue($message, $valid) {
	global $testRan;
	$testRan++;

	if(!$valid) {
		echo "  ** ERROR: $message\n";
	}
	return $valid;
}

function assertFalse($message, $valid) {
	return assertTrue($message, !$valid);
}

/**
 * Test all
 */
function allTests() {
	$success = 0;
	$list = getUnitTest();
	$nb = count($list);
	
	printf("\nTesting %d functions:\n\n", $nb);

	for($i = 0; $i < $nb; $i++) {
		printf("	Testing : %s\n", $list[$i]);
		$success += $list[$i]();
	}

	return $success;
}

/**
 * See if this work
 */
function main() {
	global $testRan;
	$result = allTests();
	printf("\n\nTests ran: %d\n", $testRan);

	if ($result != $testRan) {
		printf("Tests passed: %d\n", $result);
		printf("Tests failed: %d\n", $testRan-$result);
	}
	else {
		printf("\n** ALL TESTS PASSED **\n");
	}
	printf("\n");
}

main();
