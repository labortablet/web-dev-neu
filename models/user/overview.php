<?php

/**
 * Get all users
 *
 * @param int $limit
 *        	Limit request
 */
function getUsers($limit) {

	global $db;
	return $db->getUsers ( $limit );

}

?>