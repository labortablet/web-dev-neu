<?php
global $db;

$GLOBALS ["targetId"] = $targetId;

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'deleteGroup') {
	$db->deleteGroup ( $GLOBALS ["targetId"] );
	
	header ( "Location: {PROJECT_ROOT}/group/overview" );
}

/**
 * Gets the current group from the database
 */
function getGroup() {

	global $db;
	return $db->getGroup ( $GLOBALS ["targetId"] );

}

?>