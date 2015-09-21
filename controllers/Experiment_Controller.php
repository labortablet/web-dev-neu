<?php

/**
 *
 * @author Andre Beging
 *        
 *         Project Controller Class
 *        
 */
class Experiment_Controller extends Controller {

	protected $defaultMethod = "experiment";

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function view($args = null) {

		require 'models/experiment/view.php';
		if (file_exists ( "views/experiment/view.php" )) {
			$this->view->render ( "experiment/view" );
		}
	
	}

	public function __call($name, $args) {

		global $db;
		if ($db->canAccessExperiment ( $_SESSION ['userid'], $name ) == 1) {
			$mergedArray = array_merge ( array (
					$name 
			), $args );
			
			return $this->view ( $mergedArray );
		}
		
		require 'models/project/my.php';
		if (file_exists ( "views/project/my.php" )) {
			$this->view->render ( "project/my" );
		}
	
	}

}