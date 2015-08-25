<?php

/**
 * Get all groups
 */
function getGroups() {

	$db = new Database ();
	return $db->getGroups ();

}

?>