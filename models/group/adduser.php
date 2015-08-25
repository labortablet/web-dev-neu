<?php
global $db;
global $helper;
$GLOBALS ["targetId"] = $targetId;

if (isset ( $_POST ['action'] ) && $_POST ['action'] = 'addUser') {
	
	if (isset ( $_POST ['userId'] ) && $_POST ['userId'] != "" && is_numeric ( $_POST ['userId'] )) {
		
		return $db->addUserToGroup ( $GLOBALS ["targetId"], $_POST ['userId'] );
		$helper->redirectToSelf ();
	}
}