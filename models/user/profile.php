<?php

/**
 * Get the logged in users groups
 */
function getGroups() {

	global $db;
	return $db->getGroupsByUser ( $_SESSION ['userid'] );

}

/**
 * Get the logged in users projects
 */
function getProjects() {

	global $db;
	return $db->getProjectsByUser ( $_SESSION ['userid'] );

}

?>