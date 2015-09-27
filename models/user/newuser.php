<?php
global $db;
global $helper;
$GLOBALS ["successMsg"] = "";
$GLOBALS ["errorMsg"] = "";
$cleanData = array ();

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

if (isset ( $_POST ['action'] ) && $_POST ['action'] = 'createUser') {
	if (! isset ( $_POST ['firstname'] ) || $_POST ['firstname'] == "") {
		$GLOBALS ["errorMsg"] .= "First name missing" . "<br />";
	}
	else {
		$cleanData ['firstname'] = $_POST ['firstname'];
	}
	
	if (! isset ( $_POST ['lastname'] ) || $_POST ['lastname'] == "") {
		$GLOBALS ["errorMsg"] .= "Last name missing" . "<br />";
	}
	else {
		$cleanData ['lastname'] = $_POST ['lastname'];
	}
	
	if (! isset ( $_POST ['email'] ) || $_POST ['email'] == "") {
		$errorMsg .= "E-Mail missing" . "<br />";
	}
	else {
		$cleanData ['email'] = $_POST ['email'];
	}
	
	if (! isset ( $_POST ['password'] ) || $_POST ['password'] == "") {
		$GLOBALS ["errorMsg"] .= "Password missing" . "<br />";
	}
	
	if (! isset ( $_POST ['password2'] ) || $_POST ['password2'] == "") {
		$GLOBALS ["errorMsg"] .= "Password confirmation missing" . "<br />";
	}
	
	if ($_POST ['password'] !== $_POST ['password2']) {
		$GLOBALS ["errorMsg"] .= "Password and password confirmation must match" . "<br />";
	}
	
	// checks complete
	
	if ($GLOBALS ["errorMsg"] == "") {
		
		$salt = $helper->createSalt ();
		$saltedPassword = $helper->saltPassword ( $salt, $_POST ['password'] );
		
		if ($res = $db->createUser ( $cleanData ['firstname'], $cleanData ['lastname'], 'path', 1, $cleanData ['email'], $salt, $saltedPassword )) {
			$GLOBALS ["successMsg"] .= "New User created! ID: " . $res;
		}
		else {
			$GLOBALS ["errorMsg"] .= $res;
		}
	}
}