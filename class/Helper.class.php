<?php

/**
 * Helper class operations
 *
 * @author Andre Beging
 */
class Helper {

	/**
	 * Generates a 32 character long UUID
	 *
	 * @return string UUID
	 */
	public function generateUUID() {

		return sprintf ( '%04x%04x%04x%04x', mt_rand ( 0, 0xffff ), mt_rand ( 0, 0xffff ), mt_rand ( 0, 0xffff ), mt_rand ( 0, 0x0fff ) | 0x4000 );
	
	}

	/**
	 * Alternative for generateUUID()
	 *
	 * @see User::generateUUID()
	 * @return string UUID
	 */
	public function createSalt() {

		return Helper::generateUUID ();
	
	}

	/**
	 * Generate password hash by password and salt
	 *
	 * @param string $password
	 *        	The actual password
	 * @param string $salt
	 *        	Salt
	 * @return string Salted password hash
	 */
	public function saltPassword($password, $salt) {

		$hashedPassword = hash ( 'sha256', $password );
		$hash = hash ( 'sha256', $salt . $hashedPassword );
		
		return $hash;
	
	}

	/**
	 * Redirects to the current page to prevent multiple POST form submissions
	 */
	public function redirectToSelf() {

		$protocol = (! empty ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] !== 'off' || $_SERVER ['SERVER_PORT'] == 443) ? 'https://' : 'http://';
		header ( 'Location: ' . $protocol . $_SERVER ["HTTP_HOST"] . $_SERVER ["REQUEST_URI"] );
		exit ( "Redirection: This should never be displayed" );
	
	}

}