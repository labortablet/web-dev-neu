<?php

/**
 *
 * @author Andre Beging
 *        
 *         About Controller Class
 *        
 */
class About_Controller extends Controller {

	protected $defaultMethod = "about";

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function about() {

		require 'models/about/about.php';
		if (file_exists ( "views/about/about.php" )) {
			$this->view->render ( "about/about" );
		}
	
	}

	public function privacy() {

		require 'models/about/privacy.php';
		if (file_exists ( "views/about/privacy.php" )) {
			$this->view->render ( "about/privacy" );
		}
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}