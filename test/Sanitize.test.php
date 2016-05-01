<?php

require('../Sanitize.class.php');
require('functions.inc.php');

/** Tests **/

function test_cleanText()
{
	$valid = 0;

	$list = array(
		"Test With Bad Char '\"" => "Test With Bad Char &#039;&quot;",
		"Test With Bad Char '\" @ :~/" => "Test With Bad Char &#039;&quot; @ :~/"

	);

	foreach($list as $k => $v)
{
		Sanitize::clean($k);
		$valid += assertTrue(__FUNCTION__ . ": Bad char removed/converted", $k == $v);
	}

	return $valid;
}

function test_cleanFile()
{
	$valid = 0;

	$list = array(
		"my_file_name_with bad_char\/'.zip" => 'my_file_name_withbad_char.zip'
	);

	foreach($list as $k => $v)
{
		Sanitize::clean($k, Sanitize::SANITIZE_FILE_FOLDER);
		$valid += assertTrue(__FUNCTION__ . ": Bad char removed/converted", $k == $v);
	}

	return $valid;
}

function test_cleanEmail()
{
	$valid = 0;

	$list = array(
		"my_'email\"\@domain _.com" => "my_email@domain_.com"
	);

	foreach($list as $k => $v)
{
		Sanitize::clean($k, Sanitize::SANITIZE_EMAIL);
		$valid += assertTrue(__FUNCTION__ . ": Bad char removed/converted", $k == $v);
	}

	return $valid;
}

function test_cleanAll()
{
	$valid = 0;

	$list = array(
		'var1' => "Test With Bad Char '\"",
		'var2' => "½¼³¤¢£@±\)(*&$/!| '\""
	);

	Sanitize::cleanAll($list);
	$valid += assertTrue(__FUNCTION__ . ": Bad char removed/converted", $list['var1'] == 'Test With Bad Char &#039;&quot;');
	$valid += assertTrue(__FUNCTION__ . ": Bad char removed/converted", $list['var2'] == '&frac12;&frac14;&sup3;&curren;&cent;&pound;@&plusmn;\)(*&amp;$/!| &#039;&quot;');

	return $valid;
}

function getUnitTest()
{
	$id = 0;

	$list[$id++] = "test_cleanText";
	$list[$id++] = "test_cleanFile";
	$list[$id++] = "test_cleanEmail";
	$list[$id++] = "test_cleanAll";

	return $list;
}
