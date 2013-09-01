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
    protected $_code = 200;
    protected $_protocol = 'HTTP/1.0';
    protected $_output = '';
    protected $_response = array(
        'Server' => 'Tiny',
        'Content-Type' => 'text/html',
        );
    function __construct(Array $caller,Request $request) {
        try{
        	$className = ucfirst($caller[0]) . '_Controller';
    		if (!class_exists($className)) {
    			Core::import(TINY_CONTROLLER_DIRNAME . '.' . strtolower($caller[0]));
    		}
    		$tmp_ref = new ReflectionClass($className);
            $controller = $tmp_ref -> newInstanceArgs(array($request,$this));
            $caller[0] = $controller;
            $this->_caller = $caller;
            $this->_request = $request;
        }catch(Tiny_Exception $e){
            $output = '';
            $This->_code = 500;
       }
    }
    
    function redirect($url){
        $this->_code = 301;
        $this->_response['Location'] = $url;
    }
    
    
    function setHeader($head){
    	$this->_response = array_merge($this->_response,$head);
    }
    
    function &output(){
        try{
       	$output = call_user_func($this->_caller);
       }catch(Tiny_Exception $e){
            $output = '';
            $This->_code = 500;
       }
        $output = $this->_output . $output;
        $this->_response['Content_Length'] = strlen($output);
        $this->_response['Date'] = date('D, d M Y H:i:s e');
        $header = "{$this->_protocol} {$this->_code} OK\r\n";
        $header .= implode("\r\n", $this->_response);
        $header .= "\r\n";
        return $header . $output;
    }
	
	function write($str){
		$this->_output .= $str;
	}
    
}