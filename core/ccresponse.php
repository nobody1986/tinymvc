<?php
/**
 * Description of response
 *
 * @author Administrator
 */
class CcResponse extends Response {
    protected $_caller;
    protected $_request;
    protected $_responseHandler;
    function __construct(Array $caller,Request $request) {
    	$className = ucfirst($caller[0]) . '_Controller';
		if (!class_exists($className)) {
			Core::import(TINY_CONTROLLER_DIRNAME . '.' . strtolower($caller[0]));
		}
		$tmp_ref = new ReflectionClass($className);
        $controller = $tmp_ref -> newInstanceArgs(array($request,$this));
        $caller[0] = $controller;
        $this->_caller = $caller;
        $this->_request = $request;
    }
    
    function redirect($url){
        header("Location: $url");
    }
    
    function setResponseHandler($response){
    	$this->_responseHandler = $response;
    }
    
    function header($head){
    	$this->_responseHandler->writeHead(200, array('Content-Type' => 'text/plain'));
    }
    
    function &output(){
       	$output = call_user_func($this->_caller);
        return $output;
    }
	
	function write($str){
		$this->_responseHandler->write($str);
	}
    
}