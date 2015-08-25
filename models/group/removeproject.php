<?php
global $db;

$GLOBALS ["targetGroup"] = $targetGroup;
$GLOBALS ["targetProject"] = $targetProject;

/**
 * Get the current group
 */
function getGroup() {

	global $db;
	return $db->getGroup ( $GLOBALS ["targetGroup"] );

}

/**
 * Get the current project
 */
function getProject() {

	global $db;
	return $db->getProject ( $GLOBALS ["targetProject"] );

}

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'removeProject') {
	$db->removeProjectFromGroup ( $GLOBALS ["targetGroup"], $GLOBALS ["targetProject"] );
	$db->removeUserFromGroup ( $GLOBALS ["targetGroup"], $GLOBALS ["targetProject"] );
	
	header ( "Location: " . PROJECT_ROOT . "/group/info/{$targetGroup}" );
}

?>