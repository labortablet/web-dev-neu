<?php

/**
 * Bootstrap class for project
 *
 * @author Andre Beging
 *        
 */
class App {

	protected $controller = 'User_Controller'; // default controller
	protected $method = '';

	protected $params = [ ];

	function __construct() {

		global $self;
		global $db;
		
		$url = $this->parseUrl ();
		
		// Check for public accessible controllers like about, or a landing page
		$publicControllers = array (
				"about" 
		);
		
		if (in_array ( $url [0], $publicControllers )) {
			$this->regularCall ( $url );
			exit ();
		}
		
		// session handling
		$session = new Session ();
		
		if (! $session->isValid ()) {
			$this->loginCall ();
		}
		else {
			$self = $db->getUser ( $_SESSION ["userid"] );
			$this->regularCall ( $url );
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
	private function regularCall($url) {

		$controllerName = strtoupper ( substr ( $url [0], 0, 1 ) ) . strtolower ( substr ( $url [0], 1 ) );
		
		if (file_exists ( 'controllers/' . $controllerName . '_Controller.php' )) {
			$this->controller = $controllerName . "_Controller";
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