<?php
global $db;
global $helper;
$GLOBALS ["targetId"] = $targetId;

$error = false;
if (isset ( $_POST ["action"] ) && $_POST ["action"] == "updateGroupSettings") {
	
	if (! isset ( $_POST ["groupName"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["groupDescription"] )) {
		$error = true;
	}
	
	if (! $error) {
		$db->updateGroupSettings ( $targetId, $_POST ["groupName"], $_POST ["groupDescription"] );
		
		$helper->redirectToSelf ();
	}

}

/**
 * Get the current group from the database
 */
function getGroup() {

	global $db;
	return $db->getGroup ( $GLOBALS ["targetId"] );

}

/**
 * Get the users of the current group
 */
function getUsers() {

	global $db;
	return $db->getUsersByGroup ( $GLOBALS ["targetId"] );

}

/**
 * Get the project of the current group
 */
function getProjects() {

	global $db;
	return $db->getProjectsByGroup ( $GLOBALS ["targetId"] );

}

/**
 * Get the users that are not member of the current group
 */
function getUsersNotInGroup() {

	global $db;
	return $db->getUsersNotInGroup ( $GLOBALS ["targetId"] );

}

/**
 * Get the projects that are not assigned with the current group
 */
function projectsNotInGroup() {

	global $db;
	return $db->projectsNotInGroup ( $GLOBALS ["targetId"] );

}

?>