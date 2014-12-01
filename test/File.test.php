<?php

require('functions.inc.php');

require('../File.class.php');

class FileTest extends File {

}

$File1 = new File(5);
for($i = 1; $i <= 10; $i++) {
	$File1->add($i);
}
showTest('Test 1', "Current item: " . $File1->get(), "Total items: " . $File1->getNumberItems());

$File2 = new File(3);
$File2->add('John Doe');
$File2->add('Jane Smith');
showTest('Test 2', "Current item: " . $File2->get(), "Total items: " . $File2->getNumberItems());

$File3 = new File(10);
for($i = 1; $i <= 10; $i++) {
	$File3->add($i);
}
$File3->remove(3);
showTest('Test 3', "Current item: " . $File3->get(), "Total items: " . $File3->getNumberItems());

$File4 = new File(10);
for($i = 1; $i <= 10; $i++) {
	$File4->add($i);
}
$File4->remove(30);
showTest('Test 4', "Current item: " . $File4->get(), "Total items: " . $File4->getNumberItems());

$File5 = new File(3);
for($i = 1; $i <= 10; $i++) {
	$File5->add($i);
}
showTest('Test 5', "Current item: " . $File5->get(), "Total items: " . $File5->getNumberItems());

echo "\n";
