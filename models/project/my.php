<?php
global $db;
global $helper;

$error = false;
if (isset ( $_POST ["action"] ) && $_POST ["action"] == "createExperiment") {
	
	if (! isset ( $_POST ["experimentName"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["experimentDescription"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["experimentProject"] ) || ! is_numeric ( $_POST ["experimentProject"] )) {
		$error = true;
	}
	
	if (! $error) {
		$db->createExperiment ( $_POST ["experimentProject"], $_POST ["experimentName"], $_POST ["experimentDescription"] );
		
		$helper->redirectToSelf ();
	}

}

if (isset ( $_POST ["action"] ) && $_POST ["action"] == "deleteExperiment") {
	
	if (! isset ( $_POST ["experimentId"] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ["moveToExperiment"] )) {
		$error = true;
	}
	
	if (! $error) {
		$db->deleteExperiment ( $_POST ["experimentId"], $_POST ["moveToExperiment"] );
		
		$helper->redirectToSelf ();
	}

}

/**
 * Get the projects of the current user
 */
function getProjects() {

	global $db;
	return $db->getProjectsByUser ( $_SESSION ['userid'] );

}

/**
 * Get experiments by a given project id
 *
 * @param int $projectId        	
 */
function getExperiments($projectId) {

	global $db;
	return $db->getExperiments ( $projectId, $_SESSION ['userid'] );

}

function getUserExperiments($experimentToExclude) {

	global $db;
	return $db->getUserExperiments ( $_SESSION ['userid'], $experimentToExclude );

}

?>