<?php

require('functions.inc.php');

require('../BaseCrypt.class.php');

class BaseCryptTest extends BaseCrypt {
}

$test1 = BaseCryptTest::getHash(1);
showTest('Test ' . $testCounter++, $test1);

$test2 = BaseCryptTest::getHash(1517);
showTest('Test ' . $testCounter++, $test2);

$test3 = BaseCryptTest::getHash(14958187511);
showTest('Test ' . $testCounter++, $test3);

$test4 = BaseCryptTest::getHash(1517, 7);
showTest('Test ' . $testCounter++, $test4);

$test5 = BaseCryptTest::getHash(627, 0);
showTest('Test ' . $testCounter++, $test5);

$test6 = BaseCryptTest::getHash(882287, 1);
showTest('Test ' . $testCounter++, $test6);
