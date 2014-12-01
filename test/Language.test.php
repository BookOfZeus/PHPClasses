<?php

require('functions.inc.php');

require('../Language.class.php');

class LanguageTest extends Language {

}

$Lang1 = new LanguageTest();
showTest('Test 1', $Lang1->getLanguage(), $Lang1->getCode());


$Lang2 = new LanguageTest();
$Lang2->setLanguage('zh-hk');
showTest('Test 2', $Lang2->getLanguage(), $Lang2->getCode());

$Lang3 = new LanguageTest();
$Lang3->setLanguage('php');
showTest('Test 3', $Lang3->getLanguage(), $Lang3->getCode());

echo "\n";
