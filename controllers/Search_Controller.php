<?php

/**
 *
 * @author Andre Beging
 *        
 *         Search Controller Class
 *        
 */
class Search_Controller extends Controller {
	protected $defaultMethod = "searchSwitch";
	function __construct() {
		parent::__construct ();
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
	}
	public function searchSwitch() {
		if (isset ( $_GET ['s'] ) && $_GET ['s'] != "") {
			return $this->results ();
		}
		
		return $this->search ();
	}
	public function search() {
		require 'models/search/search.php';
		if (file_exists ( "views/search/search.php" )) {
			$this->view->render ( "search/search" );
		}
	}
	public function results() {
		require 'models/search/result.php';
		if (file_exists ( "views/search/result.php" )) {
			$this->view->render ( "search/result" );
		}
	}
	public function __call($name, $args) {
		parent::__call ( $name, $args );
	}
}