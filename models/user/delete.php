<?php
global $db;
$GLOBALS ["targetId"] = $targetId;

/**
 * Get the user to be deleted
 */
function getUser() {

	global $db;
	return $db->getUser ( $GLOBALS ["targetId"] );

}

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'deleteUser') {
	$db->deleteUser ( $GLOBALS ["targetId"] );
	
	header ( "Location: {PROJECT_ROOT}/user/overview" );
}

?>