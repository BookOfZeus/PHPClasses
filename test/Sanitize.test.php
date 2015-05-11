<?php

require('functions.inc.php');

require('../Sanitize.class.php');

class SanitizeTest extends Sanitize {
}

$var1 = "Test With Bad Char '\"";
SanitizeTest::clean($var1);
showTest('Test ' . $testCounter++, "Variable: " . $var1);

$_POST['key'] = "Test With Bad Char '\" @ :~/";
SanitizeTest::clean($_POST['key']);
showTest('Test ' . $testCounter++, "Variable: " . $_POST['key']);

$file = "my_file_name_with bad_char\/'.zip";
SanitizeTest::clean($file, Sanitize::SANITIZE_FILE_FOLDER);
showTest('Test ' . $testCounter++, "Variable: " . $file);

$email = "my_'email\"\@domain _.com";
SanitizeTest::clean($email, Sanitize::SANITIZE_EMAIL);
showTest('Test ' . $testCounter++, "Variable: " . $email);

$array = array(
	'var1' => "Test With Bad Char '\"",
	'var2' => "½¼³¤¢£@±\)(*&$/!| '\""
);

Sanitize::cleanAll($array);
showTest('Test ' . $testCounter++, "Variable: " . print_r($array,1));


echo "\n";
