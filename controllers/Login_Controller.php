<?php

/**
 *
 * @author Andre Beging
 *        
 *         Login Controller Class
 *        
 */
class Login_Controller extends Controller {

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function login() {

		require 'models/login/login.php';
		if (file_exists ( "views/login/login.php" )) {
			$this->view->render ( "login/login" );
		}
	
	}

	public function logout() {

		require 'models/login/logout.php';
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}