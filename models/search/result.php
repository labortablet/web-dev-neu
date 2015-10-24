<?php 
global $db;

function getResults() {
	global $db;
	return $db->performSearch($_GET["s"]);
}
?>