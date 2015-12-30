<?php
global $db;
global $self;
global $helper;

$experimentId = $args [0];
$GLOBALS ["experimentId"] = $experimentId;

var_dump ( $_POST );

$error = false;
if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'createEntryText') {
	
	if (! isset ( $_POST ['entryTitle'] ) || $_POST ['entryTitle'] == "") {
		$error = true;
	}
	
	if (! isset ( $_POST ['entryAttachment'] ) || $_POST ['entryAttachment'] == "") {
		$error = true;
	}
	
	if (! $error) {
		
		$db->createEntry ( 1, $experimentId, $self ["id"], $_POST ['entryTitle'], $_POST ['entryAttachment'] );
		$helper->redirectToSelf ();
	}
}

if (isset ( $_POST ["action"] ) && $_POST ["action"] == "createEntryTable") {
	
	if (! isset ( $_POST ['entryTitle'] ) || $_POST ['entryTitle'] == "") {
		$error = true;
	}
	
	if (! isset ( $_POST ['rowCount'] ) || ! is_numeric ( $_POST ['rowCount'] )) {
		$error = true;
	}
	
	if (! isset ( $_POST ['colCount'] ) || ! is_numeric ( $_POST ['colCount'] )) {
		$error = true;
	}
	
	if (! $error) {
		$attachmentString = "";
		for($r = 1; $r <= $_POST ['rowCount']; $r ++) {
			for($c = 1; $c <= $_POST ['colCount']; $c ++) {
				$attachmentString .= @$_POST ["R{$r}C{$c}"];
				if ($c < $_POST ['colCount']) {
					$attachmentString .= ",";
				}
			}
			if ($r < $_POST ['rowCount']) {
				$attachmentString .= ";";
			}
		}
		
		$db->createEntry ( 2, $experimentId, $self ["id"], $_POST ['entryTitle'], $attachmentString );
		$helper->redirectToSelf ();
	}

}

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'createEntryImage') {
	
	if (! isset ( $_POST ['entryTitle'] ) || $_POST ['entryTitle'] == "") {
		$error = true;
	}
	
	if (! isset ( $_POST ['entryImageName'] ) || $_POST ['entryImageName'] == "") {
		$error = true;
	}
	
	if (! isset ( $_POST ['entryImageData'] ) || $_POST ['entryImageData'] == "") {
		$error = true;
	}
	
	if (! $error) {
		
		$db->createEntry ( 3, $experimentId, $self ["id"], $_POST ['entryTitle'], $_POST ['entryImageData'] );
		$helper->redirectToSelf ();
	}

}

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
		case "3" :
			return renderEntryImage ( $data );
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

/**
 * Renders an image
 *
 * @param string $data        	
 */
function renderEntryImage($data) {

	return '<img src="' . $data . '" style="max-width: 100%;">';

}