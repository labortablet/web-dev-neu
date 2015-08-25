<?php
global $db;

$GLOBALS ["targetGroup"] = $targetGroup;
$GLOBALS ["targetUser"] = $targetUser;

/**
 * Get the current group
 */
function getGroup() {

	global $db;
	return $db->getGroup ( $GLOBALS ["targetGroup"] );

}

/**
 * Get the user the be removed from the group
 */
function getUser() {

	global $db;
	return $db->getUser ( $GLOBALS ["targetUser"] );

}

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'removeUser') {
	global $db;
	$db->removeUserFromGroup ( $GLOBALS ["targetGroup"], $GLOBALS ["targetUser"] );
	
	header ( "Location: " . PROJECT_ROOT . "/group/info/{$targetGroup}" );
}

?>