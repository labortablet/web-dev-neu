<?php

/**
 * Bootstrap class for project
 *
 * @author Andre Beging
 *        
 */
class App {

	protected $controller = 'User_Controller'; // default controller
	protected $method = 'overview';

	protected $params = [ ];

	function __construct() {

		global $self;
		global $db;
		
		// session handling
		$session = new Session ();
		
		// var_dump($_SESSION);
		
		// var_dump($session->isValid());
		
		if (! $session->isValid ()) {
			$this->loginCall ();
		}
		else {
			$self = $db->getUser ( $_SESSION ["userid"] );
			$db->getUser ( 5 );
			$this->regularCall ();
		}
	
	}

	/**
	 * Called if no valid session was found
	 */
	private function loginCall() {

		$this->controller = 'Login_Controller';
		$this->method = 'login';
		
		require 'controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller ();
		
		$this->controller->{$this->method} ();
	
	}

	/**
	 * Called if a the user is logged in and a valid session was found
	 */
	private function regularCall() {

		$url = $this->parseUrl ();
		
		if (file_exists ( 'controllers/' . $url [0] . '_Controller.php' )) {
			$this->controller = $url [0] . "_Controller";
			unset ( $url [0] );
		}
		
		require 'controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller ();
		
		if (isset ( $url [1] )) {
			
			$this->method = $url [1];
			unset ( $url [1] );
			
			$this->params = $url ? array_values ( $url ) : [ ];
			
			call_user_func_array ( [ 
					$this->controller,
					$this->method 
			], $this->params );
		}
		else {
			call_user_func_array ( [ 
					$this->controller,
					"defaultMethod" 
			], $this->params );
		}
	
	}

	/**
	 * Parses the url given via GET and returns an array
	 *
	 * Returns false is no url was set
	 *
	 * @return multitype: boolean
	 */
	private function parseUrl() {

		if (isset ( $_GET ['url'] )) {
			$urlParams = rtrim ( $_GET ['url'], '/' );
			$urlParams = filter_var ( $urlParams, FILTER_SANITIZE_URL );
			$urlParams = explode ( '/', $urlParams );
			
			return $urlParams;
		}
		return false;
	
	}

}