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

	public function my() {

		require 'models/project/my.php';
		if (file_exists ( "views/project/my.php" )) {
			$this->view->render ( "project/my" );
		}
	
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
		
		require 'models/project/create.php';
		if (file_exists ( "views/project/create.php" )) {
			$this->view->render ( "project/create" );
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
		require 'models/project/delete.php';
		if (file_exists ( "views/project/delete.php" )) {
			$this->view->render ( "project/delete" );
		}
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}