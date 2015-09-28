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

	/**
	 * Checks if a stored session is (still) valid by the challenge token stored inside the database
	 *
	 * @return boolean
	 */
	public function isValid() {

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
		
		$dbChallenge = strtolower ( $res [0] ['challenge'] );
		$calcChallenge = strtolower ( Session::calculateChallenge ( $_SESSION ['sessionid'] ) );
		
		if ($dbChallenge == $calcChallenge) {
			return true;
		}
	
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