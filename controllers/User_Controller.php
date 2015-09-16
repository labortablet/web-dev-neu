<?php

/**
 *
 * @author Andre Beging
 *        
 *         User Controller Class
 *        
 */
class User_Controller extends Controller {

	protected $defaultMethod = "profile";

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
		
		require 'models/user/overview.php';
		if (file_exists ( "views/user/overview.php" )) {
			$this->view->render ( "user/overview" );
		}
	
	}

	public function newuser() {

		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}
		
		require 'models/user/newuser.php';
		if (file_exists ( "views/user/newuser.php" )) {
			$this->view->render ( "user/newuser" );
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
		require 'models/user/info.php';
		if (file_exists ( "views/user/info.php" )) {
			$this->view->render ( "user/info" );
		}
	
	}

	public function profile() {

		require 'models/user/profile.php';
		if (file_exists ( "views/user/profile.php" )) {
			$this->view->render ( "user/profile" );
		}
	
	}

	public function changepassword($args = null) {

		if (! $this->isAdmin) {
			return $this->__call ( $this->defaultMethod, array () );
		}
		
		$targetId = ( int ) $args;
		
		if ($targetId == null) {
			return $this->overview ();
		}
		
		require 'models/user/changepassword.php';
		if (file_exists ( "views/user/changepassword.php" )) {
			$this->view->render ( "user/changepassword" );
		}
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}