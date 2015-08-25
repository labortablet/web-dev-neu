<?php
header ( "Content-Type: text/html; charset=utf-8" );
ini_set ( 'display_errors', '1' );
define ( "DEBUG", 0 );
define ( "GODMODE", 1 );

/**
 * Constants
 */

define ( "PROJECT_ROOT", "/lablet" );

require 'class/db.class.php';
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
$session = new Session ();
$GLOBALS ["nav"] = new Navigation ();
$GLOBALS ["helper"] = new Helper ();
$app = new App ();

