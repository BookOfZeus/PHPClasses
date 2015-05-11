<?php

require('functions.inc.php');

require('../Language.class.php');

class LanguageTest extends Language {

}

$Lang1 = new LanguageTest();
showTest('Test ' . $testCounter++, $Lang1->getLanguage(), $Lang1->getCode());


$Lang2 = new LanguageTest();
$Lang2->setLanguage('zh-hk');
showTest('Test ' . $testCounter++, $Lang2->getLanguage(), $Lang2->getCode());

$Lang3 = new LanguageTest();
$Lang3->setLanguage('php');
showTest('Test ' . $testCounter++, $Lang3->getLanguage(), $Lang3->getCode());

echo "\n";
