<?php

/**
 *
 * @author Andre Beging
 *        
 *         Settings Controller Class
 *        
 */
class Settings_Controller extends Controller {

	protected $defaultMethod = "settings";

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function settings($args = null) {

		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}
		
		require 'models/settings/settings.php';
		if (file_exists ( "views/settings/settings.php" )) {
			$this->view->render ( "settings/settings" );
		}
	
	}

}