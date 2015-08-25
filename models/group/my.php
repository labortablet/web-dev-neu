<?php

/**
 * Get the groups of the current user
 */
function getGroups() {

	global $db;
	return $db->getGroupsByUser ( $_SESSION ['userid'] );

}

?>