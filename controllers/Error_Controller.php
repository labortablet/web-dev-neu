<?php

/**
 * TODO wird gar nicht benutzt
 * 
 * @author Andre Beging
 *        
 */
class Error_Controller extends Controller {

	private $errorcode;

	function __construct($err = null) {

		parent::__construct ();
		
		$this->errorcode = $err;
		
		if (DEBUG === 1) {
			var_dump ( "Inside " . get_class () );
		}
		
		if ($this->errorcode != null) {
			$this->{"_" . $this->errorcode} ();
		}
		else {
			$this->{"_default"} ();
		}
	
	}

	public function _403() {

		if (file_exists ( "views/error/" . $this->errorcode . ".php" )) {
			$this->view->render ( "error/" . $this->errorcode );
		}
	
	}

	public function _404() {

		if (file_exists ( "views/error/" . $this->errorcode . ".php" )) {
			$this->view->render ( "error/" . $this->errorcode );
		}
	
	}

	public function __call($name, $args) {

		if (method_exists ( $this, '_' . $name )) {
			$this->{"_" . $name} ();
		}
		
		parent::__call ( $name, $args );
	
	}

}