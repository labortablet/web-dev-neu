<?php

$GLOBALS ["targetId"] = $targetId;

/**
 * Get the current project
 */
function getProject() {

	global $db;
	return $db->getProject ( $GLOBALS ["targetId"] );

}

/**
 * Get the users assigned with this project
 */
function getUsers() {

	global $db;
	return $db->getUsersByGroup ( $GLOBALS ["targetId"] );

}

/**
 * Get the groups that is the current project assigned with
 */
function getGroups() {

	global $db;
	return $db->getGroupsByProject ( $GLOBALS ["targetId"] );

}

?>