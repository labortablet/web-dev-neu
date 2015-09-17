<?php

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

?>