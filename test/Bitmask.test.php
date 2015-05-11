<?php

require('functions.inc.php');

require('../Bitmask.class.php');

class BitmaskTest extends Bitmask {
}

$Bitmask1 = new Bitmask();
$Bitmask1->set(Bitmask::READ);
showTest('Test ' . $testCounter++, $Bitmask1->hasPermission(Bitmask::READ));

$Bitmask2 = new Bitmask();
$Bitmask2->set(Bitmask::READ);
showTest('Test ' . $testCounter++, $Bitmask2->hasPermission(Bitmask::WRITE));

$Bitmask3 = new Bitmask();
$Bitmask3->set(Bitmask::READ | Bitmask::WRITE);
showTest('Test ' . $testCounter++, $Bitmask3->hasPermission(Bitmask::READ));
showTest('Test ' . $testCounter++, $Bitmask3->hasPermission(Bitmask::WRITE));
showTest('Test ' . $testCounter++, $Bitmask3->hasPermission(Bitmask::READ & Bitmask::WRITE));
showTest('Test ' . $testCounter++, $Bitmask3->hasPermission(Bitmask::READ | Bitmask::UPDATE));

$Bitmask4 = new Bitmask();
$Bitmask4->set(Bitmask::READ | Bitmask::WRITE);
showTest('Test ' . $testCounter++, $Bitmask4->hasPermission(Bitmask::WRITE));
$Bitmask4->revoke(Bitmask::WRITE);
showTest('Test ' . $testCounter++, $Bitmask4->hasPermission(Bitmask::WRITE));



