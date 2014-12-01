<?php

require('functions.inc.php');

require('../Pile.class.php');

class PileTest extends Pile {

}

$Pile1 = new Pile(5);
for($i = 1; $i <= 10; $i++) {
	$Pile1->add($i);
}
showTest('Test 1', "Current item: " . $Pile1->get(), "Total items: " . $Pile1->getNumberItems());

$Pile2 = new Pile(3);
$Pile2->add('John Doe');
$Pile2->add('Jane Smith');
showTest('Test 2', "Current item: " . $Pile2->get(), "Total items: " . $Pile2->getNumberItems());

$Pile3 = new Pile(10);
for($i = 1; $i <= 10; $i++) {
	$Pile3->add($i);
}
$Pile3->remove(3);
showTest('Test 3', "Current item: " . $Pile3->get(), "Total items: " . $Pile3->getNumberItems());

$Pile4 = new Pile(10);
for($i = 1; $i <= 10; $i++) {
	$Pile4->add($i);
}
$Pile4->remove(30);
showTest('Test 4', "Current item: " . $Pile4->get(), "Total items: " . $Pile4->getNumberItems());

$Pile5 = new Pile(3);
for($i = 1; $i <= 10; $i++) {
	$Pile5->add($i);
}
showTest('Test 5', "Current item: " . $Pile5->get(), "Total items: " . $Pile5->getNumberItems());

echo "\n";
