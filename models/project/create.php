<?php
global $db;

/**
 * Returns the success message
 *
 * @return string
 */
function successMsg() {

	return $GLOBALS ["successMsg"];

}

/**
 * Returns the error message
 *
 * @return string
 */
function errorMsg() {

	return $GLOBALS ["errorMsg"];

}

$GLOBALS ["successMsg"] = "";
$GLOBALS ["errorMsg"] = "";
$cleanData = array ();

if (isset ( $_POST ['action'] ) && $_POST ['action'] = 'createProject') {
	
	if (! isset ( $_POST ['name'] ) || $_POST ['name'] == "") {
		$GLOBALS ["errorMsg"] .= "Project name missing" . "<br />";
	}
	else {
		$cleanData ['name'] = $_POST ['name'];
	}
	
	if (! isset ( $_POST ['description'] ) || $_POST ['description'] == "") {
		$GLOBALS ["errorMsg"] .= "Description missing" . "<br />";
	}
	else {
		$cleanData ['description'] = $_POST ['description'];
	}
	
	// checks complete
	
	if ($GLOBALS ["errorMsg"] == "") {
		
		if ($res = $db->createProject ( $cleanData ["name"], $cleanData ["description"] )) {
			$GLOBALS ["successMsg"] .= "New Project created! ID: " . $res;
		}
		else {
			$GLOBALS ["errorMsg"] .= $res;
		}
	}
}