<?php
header ( "Content-Type: text/html; charset=utf-8" );

ini_set ( 'display_errors', '1' );

require 'settings.php';
require 'class/Database.class.php';
require 'class/Helper.class.php';
require 'class/Session.class.php';
require 'class/Navigation.php';

/**
 * Autoload libraries from /libs/
 *
 * @param
 *        	$files
 */
function __autoload($file) {

	if (file_exists ( 'libs/' . $file . '.php' )) {
		require 'libs/' . $file . '.php';
	}

}
spl_autoload_register ( '__autoload' );

$GLOBALS ["db"] = new Database ();

session_start ();
$GLOBALS ["session"] = new Session ();
$GLOBALS ["nav"] = new Navigation ();
$GLOBALS ["helper"] = new Helper ();
$app = new App ();

