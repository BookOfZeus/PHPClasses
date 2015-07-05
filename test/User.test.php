<?php

require('../Core.class.php');
require('../User.class.php');
require('functions.inc.php');

/** Need DB **/

/*
	CREATE DATABASE test_db;
	USE test_db;

	CREATE TABLE `user` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `username` varchar(200) NOT NULL,
	  `password` varchar(255) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `username` (`username`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	INSERT INTO `user` SET `username` = 'BobaFett', `password` = 'sarlacsucks';

*/


/** Tests **/

function test_isLogged() {
	$valid = 0;

	$user = new user('id');
	$isLogged = $user->isLogged();
	$valid += assertTrue(__FUNCTION__ . ": The user is not logged", $isLogged === FALSE);

	return $valid;
}

function test_validLogin() {
	$valid = 0;

	$user = new user('id');
	$good = $user->validLogin('bb', 'fet');
	$valid += assertTrue(__FUNCTION__ . ": The user is not valid", $good === FALSE);

	$good = $user->validLogin('BobaFett', 'sarlacsucks');
	$valid += assertTrue(__FUNCTION__ . ": The user is valid", is_array($good) && $good['id'] == 1);

	return $valid;
}

function test_updatePass() {
	$valid = 0;

	// hack

	$_SESSION['id'] = 1; // User id

	$user = new user('id');

	$pass = $user->updateuserPassword('awesome', 1, 2);
	$valid += assertTrue(__FUNCTION__ . ": The password is unchanged (1)", $pass == 0);

	$pass = $user->updateuserPassword('sarlacsucks', 1, 2);
	$valid += assertTrue(__FUNCTION__ . ": The password is unchanged (2)", $pass == 0);

	$pass = $user->updateuserPassword('sarlacsucks', 1, 1);
	$valid += assertTrue(__FUNCTION__ . ": The password is unchanged (3)", $pass == 1);

	$pass = $user->updateuserPassword(1, 'sarlacsucks', 'sarlacsucks');
	$valid += assertTrue(__FUNCTION__ . ": The password is unchanged (4)", $pass == 1);

	return $valid;
}

function getUnitTest() {

	$GLOBALS['dbc'] = new PDO('mysql:host=localhost;dbname=test_db', 'root', '', array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE));
	$GLOBALS['dbc']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$GLOBALS['dbc']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id = 0;

	$list[$id++] = "test_isLogged";
	$list[$id++] = "test_validLogin";
	$list[$id++] = "test_updatePass";

	return $list;
}
