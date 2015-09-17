<?php

/**
 *
 * @author Andre Beging
 *        
 */
class Me_Controller extends Controller {

	protected $defaultMethod = "me";

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function me() {

		require 'models/user/profile.php';
		if (file_exists ( "views/user/profile.php" )) {
			$this->view->render ( "user/profile" );
		}
	
	}

}