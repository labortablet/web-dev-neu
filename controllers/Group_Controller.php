<?php

/**
 *
 * @author Andre Beging
 *        
 *         Group Controller Class
 *        
 */
class Group_Controller extends Controller {

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

		require 'models/group/overview.php';
		if (file_exists ( "views/group/overview.php" )) {
			$this->view->render ( "group/overview" );
		}
	
	}

	public function create() {

		require 'models/group/create.php';
		if (file_exists ( "views/group/create.php" )) {
			$this->view->render ( "group/create" );
		}
	
	}

	public function my() {

		require 'models/group/my.php';
		if (file_exists ( "views/group/my.php" )) {
			$this->view->render ( "group/my" );
		}
	
	}

	public function info() {

		$args = func_get_args ();
		$targetId = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetId = $args [0];
		}
		
		if ($targetId == null) {
			return $this->overview ();
		}
		
		require 'models/group/info.php';
		if (file_exists ( "views/group/info.php" )) {
			$this->view->render ( "group/info" );
		}
	
	}

	public function delete() {

		$args = func_get_args ();
		$targetId = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetId = $args [0];
		}
		
		if ($targetId == null) {
			return $this->overview ();
		}
		
		require 'models/group/delete.php';
		if (file_exists ( "views/group/delete.php" )) {
			$this->view->render ( "group/delete" );
		}
	
	}

	public function removeUser() {

		$args = func_get_args ();
		$targetGroup = null;
		$targetUser = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetGroup = $args [0];
		}
		
		if (isset ( $args [1] ) && is_numeric ( $args [1] )) {
			$targetUser = $args [1];
		}
		
		if ($targetGroup == null || $targetUser == null) {
			return $this->overview ();
		}
		
		require 'models/group/removeuser.php';
		if (file_exists ( "views/group/removeuser.php" )) {
			$this->view->render ( "group/removeuser" );
		}
	
	}

	public function removeProject() {

		$args = func_get_args ();
		$targetGroup = null;
		$targetProject = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetGroup = $args [0];
		}
		
		if (isset ( $args [1] ) && is_numeric ( $args [1] )) {
			$targetProject = $args [1];
		}
		
		if ($targetGroup == null || $targetProject == null) {
			return $this->overview ();
		}
		
		require 'models/group/removeproject.php';
		if (file_exists ( "views/group/removeproject.php" )) {
			$this->view->render ( "group/removeproject" );
		}
	
	}

	public function addUser() {

		$args = func_get_args ();
		$targetId = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetId = $args [0];
		}
		
		if ($targetId == null) {
			return $this->overview ();
		}
		
		require 'models/group/adduser.php';
		return $this->info ( $targetId );
	
	}

	public function addProject() {

		$args = func_get_args ();
		$targetId = null;
		
		if (isset ( $args [0] ) && is_numeric ( $args [0] )) {
			$targetId = $args [0];
		}
		
		if ($targetId == null) {
			return $this->overview ();
		}
		
		require 'models/group/addproject.php';
		return $this->info ( $targetId );
	
	}

	public function __call($name, $args) {

		parent::__call ( $name, $args );
	
	}

}