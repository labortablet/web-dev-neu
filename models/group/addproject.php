<?php
global $db;
global $helper;

$GLOBALS ["targetId"] = $targetId;

if (isset ( $_POST ['action'] ) && $_POST ['action'] = 'addProject') {
	
	if (isset ( $_POST ['projectId'] ) && $_POST ['projectId'] != "" && is_numeric ( $_POST ['projectId'] )) {
		
		$db->addProjectToGroup ( $GLOBALS ["targetId"], $_POST ['projectId'] );
		$helper->redirectToSelf ();
	
	}
}