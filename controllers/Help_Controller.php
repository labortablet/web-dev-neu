<?php

/**
 *
 * @author Andre Beging
 *         TODO wird eigentlich gar nicht benutzt
 *        
 *         Help Controller Class
 *        
 */
class Help_Controller extends Controller {

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}