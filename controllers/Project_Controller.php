<?php

/**
 *
 * @author Andre Beging
 *        
 *         Project Controller Class
 *        
 */
class Project_Controller extends Controller {

	protected $defaultMethod = "my";

	function __construct() {

		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	
	}

	public function test($args = false) {

		echo "test func";
		var_dump ( $args );
	
	}

	public function overview() {
		
		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}

		require 'models/project/overview.php';
		if (file_exists ( "views/project/overview.php" )) {
			$this->view->render ( "project/overview" );
		}
	
	}

	public function create() {
		
		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}

		require 'models/group/create.php';
		if (file_exists ( "views/group/create.php" )) {
			$this->view->render ( "group/create" );
		}
	
	}

	public function info($args = null) {
		
		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}

		$targetId = ( int ) $args;
		
		if ($targetId == null) {
			return $this->overview ();
		}
		require 'models/project/info.php';
		if (file_exists ( "views/project/info.php" )) {
			$this->view->render ( "project/info" );
		}
	
	}

	public function delete($args = null) {
		
		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}

		$targetId = ( int ) $args;
		
		if ($targetId == null) {
			return $this->overview ();
		}
		require 'models/group/delete.php';
		if (file_exists ( "views/group/delete.php" )) {
			$this->view->render ( "group/delete" );
		}
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}