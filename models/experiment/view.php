<?php
$experimentId = $args [0];
$GLOBALS ["experimentId"] = $experimentId;

function getExperiment() {

	global $db;
	global $experimentId;
	return $db->getExperiment ( $experimentId );

}

function getEntries() {

	global $db;
	global $experimentId;
	return $db->getEntries ( $experimentId );

}