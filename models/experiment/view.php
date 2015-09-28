<?php
$experimentId = $args [0];
$GLOBALS ["experimentId"] = $experimentId;

/**
 * Gets the experiment data
 */
function getExperiment() {

	global $db;
	global $experimentId;
	return $db->getExperiment ( $experimentId );

}

/**
 * Gets the entries for the current experiment
 */
function getEntries() {

	global $db;
	global $experimentId;
	return $db->getEntries ( $experimentId );

}

/**
 * Renders the attachment depending on its type
 *
 * Type 1 = text
 * Type 2 = table
 *
 * @param string $data        	
 * @param string $type        	
 * @return string (Un)rendered attachment
 */
function renderEntryAttachment($data, $type) {

	switch ($type) {
		case "1" :
			return $data;
		case "2" :
			return renderEntryTable ( $data );
			break;
	}
	
	return $data;

}

/**
 * Renders a table attachment from format
 *
 * R1C1,R1C2,R1C3;R2C1,R2C2,R2C3...
 *
 * @param string $data        	
 */
function renderEntryTable($data) {

	$data = rtrim ( $data, ";" );
	$data = explode ( ";", $data );
	
	$output = "";
	foreach ( $data as $key => $val ) {
		
		$row = explode ( ",", $val );
		
		$output .= "<tr>";
		foreach ( $row as $col ) {
			$output .= "<td>" . $col . "</td>";
		}
		$output .= "</tr>";
	}
	
	return "<table class=\"table\">" . $output . "</table>";

}