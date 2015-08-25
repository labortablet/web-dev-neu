<?php

/**
 * Controls and validates the Session
 *
 * @author Andre Beging
 *        
 */
class Session extends SessionHandler {

	private $id;

	public function __construct() {

		if (DEBUG === 1) {
			var_dump ( "Sessid:" . session_id () );
		}
	
	}
	
	// is user logged in?
	public function isValid() {
		
		/*
		 * $sessionid = User::generateUUID().User::generateUUID(); var_dump("sessionid ".$sessionid); $challenge = hash('sha256',session_id().$sessionid); $challenge = substr($challenge, 16, 32); var_dump("challenge ".$challenge);
		 */
        
        /*$_SESSION['userid'] = 5;
        $_SESSION['sessionid'] = "91929722250d4399da70995cb6c84d6f";*/
        
        if (! isset ( $_SESSION ['userid'] ) || $_SESSION ['userid'] == '') {
			return false;
		}
		
		if (! isset ( $_SESSION ['sessionid'] ) || $_SESSION ['sessionid'] == '') {
			return false;
		}
		
		$db = new Database ();
		$res = $db->getChallenge ( $_SESSION ['sessionid'], $_SESSION ['userid'] );
		
		if (! $res) {
			return false;
		}
		
		$dbChallenge = strtolower ( $res ['challenge'] );
		$calcChallenge = strtolower ( Session::calculateChallenge ( $_SESSION ['sessionid'] ) );
		
		if ($dbChallenge == $calcChallenge) {
			return true;
		}
	
	}

	/**
	 * TODO notwendig???
	 */
	public function getSelf() {

		var_dump ( $_SESSION );
	
	}

	/**
	 * Calculates the Challenge ID
	 *
	 * @param string $sessionId
	 *        	Session ID
	 * @return string Challenge ID
	 */
	private function calculateChallenge($sessionId) {

		$challenge = hash ( 'sha256', session_id () . $sessionId );
		return substr ( $challenge, 16, 32 );
	
	}

}

?>