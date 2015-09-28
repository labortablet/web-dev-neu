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

		$uuidtest = sprintf ( '%04x%04x%04x%04x%04x%04x%04x%04x', 
				// 32 bits for "time_low"
				mt_rand ( 0, 0xffff ), mt_rand ( 0, 0xffff ), 
				
				// 16 bits for "time_mid"
				mt_rand ( 0, 0xffff ), 
				
				// 16 bits for "time_hi_and_version",
				// four most significant bits holds version number 4
				mt_rand ( 0, 0x0fff ) | 0x4000, 
				
				// 16 bits, 8 bits for "clk_seq_hi_res",
				// 8 bits for "clk_seq_low",
				// two most significant bits holds zero and one for variant DCE1.1
				mt_rand ( 0, 0x3fff ) | 0x8000, 
				
				// 48 bits for "node"
				mt_rand ( 0, 0xffff ), mt_rand ( 0, 0xffff ), mt_rand ( 0, 0xffff ) );
		
		return $uuidtest;
	
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
	public function saltPassword($salt, $password) {

		$salt = hex2bin ( $salt );
		
		$hashedPassword = hash ( 'sha256', $password );
		$hashedPassword = hex2bin ( $hashedPassword );
		
		$saltedPassword = hash ( 'sha256', $salt . $hashedPassword );
		$saltedPassword = strtolower ( $saltedPassword );
		
		return $saltedPassword;
		
		$password = utf8_encode ( $password );
		var_dump ( "password: " . $password );
		var_dump ( "salt: " . $salt );
		
		$hashedPassword = hash ( 'sha256', $password );
		$hashedPassword = $password;
		var_dump ( "hashedPassword: " . $hashedPassword );
		
		$hash = hash ( 'sha256', $salt . $hashedPassword );
		var_dump ( "hash: " . $hash );
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

	/**
	 * Returns a DateTime-String formattet to YYYY-MM-DD HH:MM:SS
	 */
	public function now() {

		$dateTime = new DateTime ( 'NOW' );
		return $dateTime->format ( "Y-m-d H:i:s" );
	
	}

}