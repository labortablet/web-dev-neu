<?php

/**
 * Controller super class
 *
 * @author Andre Beging
 *        
 */
class Controller {

	function __construct() {

		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
		
		$this->view = new View ();
	
	}

	public function __call($name, $args) {

		if (DEBUG === 1) {
			trigger_error ( "Missing Method: " . $name . "()", E_USER_NOTICE );
		}
		return true;
	
	}

}