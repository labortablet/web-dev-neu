<?php
$GLOBALS ["targetId"] = $targetId;
global $db;
global $helper;

/**
 * Get the current user
 */
function getUser() {

	global $db;
	return $db->getUser ( $GLOBALS ["targetId"] );

}

/**
 * Get the groups that the current user is member of
 */
function getGroups() {

	global $db;
	return $db->getGroupsByUser ( $GLOBALS ["targetId"] );

}

/**
 * Get the projects that the current user is member of
 */
function getProjects() {

	global $db;
	return $db->getProjectsByGroup ( $GLOBALS ["targetId"] );

}

if (isset ( $_POST ["action"] ) && $_POST ["action"] == "updateUserSettings") {
	
	$error = false;
	if (! isset ( $_POST ["userFirstName"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["userLastName"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["userType"] ) || is_int ( $_POST ["userType"] )) {
		$error = true;
	}
	
	if (! $error) {
		$db->updateUserSettings ( $targetId, $_POST ["userFirstName"], $_POST ["userLastName"], $_POST ["userType"] );
		
		// Redirect to self to prevent
		$helper->redirectToSelf ();
	}
}

?>