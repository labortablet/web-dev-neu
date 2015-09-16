<?php
global $db;
global $helper;
$GLOBALS ["targetId"] = $targetId;

$error = false;
if (isset ( $_POST ["action"] ) && $_POST ["action"] == "updateProjectSettings") {
	
	if (! isset ( $_POST ["projectName"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["projectDescription"] )) {
		$error = true;
	}
	
	if (! $error) {
		$db->updateProjectSettings ( $targetId, $_POST ["projectName"], $_POST ["projectDescription"] );
		
		$helper->redirectToSelf ();
	}

}

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'deleteProject') {
	$res = $db->deleteProject ( $targetId );

	header ( "Location: ".PROJECT_ROOT."/project/overview" );
}

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