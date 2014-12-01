<?php

require('functions.inc.php');

require('../Bitmask.class.php');

class BitmaskTest extends Bitmask {


}

$Bitmask1 = new Bitmask();
$Bitmask1->set(Bitmask::READ);
showTest('Test 1', $Bitmask1->hasPermission(Bitmask::READ));

$Bitmask2 = new Bitmask();
$Bitmask2->set(Bitmask::READ);
showTest('Test 2', $Bitmask2->hasPermission(Bitmask::WRITE));

$Bitmask3 = new Bitmask();
$Bitmask3->set(Bitmask::READ | Bitmask::WRITE);
showTest('Test 3', $Bitmask3->hasPermission(Bitmask::READ));
showTest('Test 4', $Bitmask3->hasPermission(Bitmask::WRITE));
showTest('Test 6', $Bitmask3->hasPermission(Bitmask::READ & Bitmask::WRITE));
showTest('Test 7', $Bitmask3->hasPermission(Bitmask::READ | Bitmask::UPDATE));

$Bitmask4 = new Bitmask();
$Bitmask4->set(Bitmask::READ | Bitmask::WRITE);
showTest('Test 8', $Bitmask4->hasPermission(Bitmask::WRITE));
$Bitmask4->revoke(Bitmask::WRITE);
showTest('Test 9', $Bitmask4->hasPermission(Bitmask::WRITE));



