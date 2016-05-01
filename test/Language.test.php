<?php

require('../Language.class.php');
require('functions.inc.php');

/** Tests **/

function test_default()
{
	$valid = 0;

	$lang = new Language();

	$code = $lang->getCode();
	$valid += assertTrue(__FUNCTION__ . ": The code should be en-us", $code == 'en-us');

	$language = $lang->getLanguage();
	$valid += assertTrue(__FUNCTION__ . ": The language should be English (United States)", $language == 'English (United States)');

	return $valid;
}

function test_zh_hk()
{
	$valid = 0;

	$lang = new Language();
	$lang->setLanguage('zh-hk');

	$code = $lang->getCode();
	$valid += assertTrue(__FUNCTION__ . ": The code should be en-us", $code == 'zh-hk');

	$language = $lang->getLanguage();
	$valid += assertTrue(__FUNCTION__ . ": The language should be English (United States)", $language == 'Chinese (Hong Kong SAR)');

	return $valid;
}

function test_invalid()
{
	$valid = 0;

	$lang = new Language();
	$lang->setLanguage('php');

	$code = $lang->getCode();
	$valid += assertTrue(__FUNCTION__ . ": The code should be en-us", $code == 'php');

	$language = $lang->getLanguage();
	$valid += assertTrue(__FUNCTION__ . ": The language should be English (United States)", $language == 'Unkwown');

	return $valid;
}

function getUnitTest()
{
	$id = 0;

	$list[$id++] = "test_default";
	$list[$id++] = "test_zh_hk";
	$list[$id++] = "test_invalid";

	return $list;
}
