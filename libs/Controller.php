<?php

/**
 * Controller super class
 *
 * @author Andre Beging
 *        
 */
class Controller {

	protected $isAdmin = false;

	function __construct() {

		global $self;
		global $db;
		
		$this->isAdmin = $db->isAdmin ( $self ["id"] );
		
		// If GODMODE is enabled, every logged in user is admin
		if (GODMODE) {
			$this->isAdmin = true;
		}
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
		
		$this->view = new View ();
	
	}

	public function __call($name, $args) {

		if (! method_exists ( $this, $this->defaultMethod )) {
			header ( "Location: " . PROJECT_ROOT );
		}
		
		call_user_func_array ( [ 
				$this,
				$this->defaultMethod 
		], $args );
	
	}

}