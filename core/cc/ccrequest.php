<?php
/**
 * Description of request
 *
 * @author Administrator
 */
class CcRequest extends Request {
	/**
	 * @string
	 */
	protected $query_string;
	/**
	 * @string
	 */
	protected $controller;
	/**
	 * @string
	 */
	protected $action;
	
	protected $_requestHandler;

	protected $_header;
	
    function __construct($header) {
    	$this->_header = $header;
    }
	
	function setRequestHandler($requestHandler){
		$this->_requestHandler = $requestHandler;
	}
	
	function getController(){
		return $this->controller;
	}
	
	function getAction(){
		return $this->action;
	}
	
	function parseHeader(){
		$path = $this->_header['path'];
		$info_parsed = array();
			$slice = explode('/', trim($path));
			$this->controller = empty($slice[1]) ? TINY_DEFAULT_CONTROLLER : trim($slice[1]);
			$this->action = empty($slice[2]) ? TINY_DEFAULT_ACTION : trim($slice[2]);
		
	}
}