<?php
$GLOBALS ["targetId"] = $targetId;
global $helper;
global $db;

/**
 * Get the current user
 */
function getUser() {

	global $db;
	return $db->getUser ( $GLOBALS ["targetId"] );

}

/**
 * Get the success message
 *
 * @return string
 */
function successMsg() {

	return $GLOBALS ["successMsg"];

}

/**
 * Get the error message
 *
 * @return string
 */
function errorMsg() {

	return $GLOBALS ["errorMsg"];

}

$GLOBALS ["successMsg"] = "";
$GLOBALS ["errorMsg"] = "";

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'changePassword') {
	
	if (! $_POST ['password'] || $_POST ['password'] == "") {
		$GLOBALS ["errorMsg"] .= "Please enter the new password<br />";
	}
	
	if (! $_POST ['confirmpassword'] || $_POST ['confirmpassword'] == "") {
		$GLOBALS ["errorMsg"] .= "Please enter the password confirmation<br />";
	}
	
	if ($_POST ['password'] != $_POST ['confirmpassword']) {
		$GLOBALS ["errorMsg"] .= "The two passwords must match<br />";
	}
	
	if ($GLOBALS ["errorMsg"] == "") {
		// var_dump($_POST);
		$salt = $helper->createSalt ();
		// var_dump("SALT CREATED", $salt);
		$saltedPassword = $helper->saltPassword ( $salt, $_POST ['password'] );
		
		if ($db->updatePassword ( $GLOBALS ["targetId"], $saltedPassword, $salt )) {
			$GLOBALS ["successMsg"] = "Success!<br />";
		}
		else {
			$GLOBALS ["errorMsg"] .= "Error - Database error. Try again<br />";
		}
	}

}

?>