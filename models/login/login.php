<?php
global $db;
global $helper;

/**
 * Returns the success message
 *
 * @return string
 */
function successMsg() {

	return $GLOBALS ["successMsg"];

}

/**
 * Returns the error message
 *
 * @return string
 */
function errorMsg() {

	return $GLOBALS ["errorMsg"];

}

$GLOBALS ["successMsg"] = "";
$GLOBALS ["errorMsg"] = "";

if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'login') {
	
	// var_dump($_POST);
	
	if (! $_POST ['email'] || $_POST ['email'] == "") {
		$GLOBALS ["errorMsg"] .= "Please enter your E-Mail to log in<br />";
	}
	
	if (! $_POST ['password'] || $_POST ['password'] == "") {
		$GLOBALS ["errorMsg"] .= "Please enter your password to log in<br />";
	}
	
	if ($GLOBALS ["errorMsg"] == "") {
		
		$res = $db->getHashByEMail ( $_POST ['email'] );
		
		// var_dump($res);
		
		if ($res) {
			
			$salt = $res ['salt'];
			
			$calcHash = $helper->saltPassword ( $res ['salt'], $_POST ['password'] );
			
			$dbHash = $res ['hash_password'];
			$dbHash = strtolower ( $dbHash );
			
			// var_dump("DBH",$dbHash);
			// var_dump("CH",$calcHash);
			
			// var_dump($dbHash == $calcHash);
			
			// exit;
			if ($calcHash == $dbHash) {
				
				session_unset ();
				$dbSessionId = $helper->generateUUID ();
				
				$dbChallenge = hash ( 'sha256', session_id () . $dbSessionId );
				$dbChallenge = substr ( $dbChallenge, 16, 32 );
				
				$sessionResult = $db->insertSession ( $res ['id'], $dbSessionId, $dbChallenge );
				
				$_SESSION ['userid'] = $res ['id'];
				$_SESSION ['sessionid'] = $dbSessionId;
				
				header ( "Location: " . PROJECT_ROOT );
			}
		
		}
		else {
			$GLOBALS ["errorMsg"] .= "Your log in information seem to be wrong<br />";
		}
	
	}

}