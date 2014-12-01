<?php

require('functions.inc.php');

require('../Core.class.php');

class CoreTest extends Core {


}

$CoreTest1 = new CoreTest();
$CoreTest1->setMessage(2, 'Invalid action');
$format1 = $CoreTest1->getFormatedError();
showTest('Test 1', $format1);


$CoreTest2 = new CoreTest();
$CoreTest2->setMessage(17, 'Upload Failed');
$format2 = $CoreTest2->getFormatedError(Core::FORMAT_JSON);
showTest('Test 2', $format2);

$CoreTest3 = new CoreTest();
$CoreTest3->setMessage(21, 'Another Fail message');
$format3 = $CoreTest3->getFormatedError(Core::FORMAT_XML);
showTest('Test 3', $format3);
