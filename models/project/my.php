<?php

/**
 * Get the projects of the current user
 */
function getProjects() {

	global $db;
	return $db->getProjectsByUser ( $_SESSION ['userid'] );

}

?>