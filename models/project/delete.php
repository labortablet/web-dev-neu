<?php
global $db;

$GLOBALS ["targetId"] = $targetId;

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'deleteProject') {
	$db->deleteProject ( $GLOBALS ["targetId"] );
	
	header ( "Location: {PROJECT_ROOT}/project/overview" );
}

/**
 * Gets the current group from the database
 */
function getProject() {

	global $db;
	return $db->getProject ( $GLOBALS ["targetId"] );

}

?>