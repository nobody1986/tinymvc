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
    protected $_protocol = 'HTTP/1.1';
    protected $_output = '';
    protected $_cookies = array();
    protected $_response = array(
        'Server' => 'Tiny',
        'Content-Type' => 'text/html',
    );

    function __construct(Array $caller, Request $request) {
        try {
            $className = ucfirst($caller[0]) . '_Controller';
            if (!class_exists($className)) {
                Core::import(TINY_CONTROLLER_DIRNAME . '.' . strtolower($caller[0]));
            }
            $tmp_ref = new ReflectionClass($className);
            $controller = $tmp_ref->newInstanceArgs(array($request, $this));
            $caller[0] = $controller;
            $this->_caller = $caller;
            $this->_request = $request;
//            var_dump($caller);
        } catch (Tiny_Exception $e) {
            $output = '';
            $This->_code = 500;
        }
    }

    function redirect($url) {
        $this->_code = 301;
        $this->_response['Location'] = $url;
    }

    function setHeader($head) {
        $this->_response = array_merge($this->_response, $head);
    }
    
    function getMimeType($path) {
//        CORE::import("core.mime");
        global $mime_types;
        $pos = strrpos($path, '.');
        $extend = substr($path,$pos + 1);
//        var_dump($mime_types);
        if(isset($mime_types[$extend])){
            return $mime_types[$extend];
        }
    }
    
    function setMimeTypeByPath($path) {
        $mime = $this->getMimeType($path);
//        var_dump($mime);
        if(!empty($mime)){
            $this->_response['Content-Type'] = $mime;
        }
    }
    
    function setCode($code) {
        $this->_code = $code;
    }

    function output() {
        try {
            $output = call_user_func($this->_caller);
        } catch (Tiny_Exception $e) {
            $output = '';
            $This->_code = 500;
        }
        $output = $this->_output . $output;
        $this->_response['Content_Length'] = strlen($output);
        $this->_response['Date'] = date('D, d M Y H:i:s e');
        $header = "{$this->_protocol} {$this->_code} OK\r\n";
        $header .= implode("\r\n", $this->_response);
        foreach ($this->_cookies as $key => $value) {
            $header .= sprint("Set-Cookie: \r\n");
        }
        $header .= "\r\n\r\n";
        return $header . $output;
    }

    function write($str) {
        $this->_output .= $str;
    }
  
    /**
     * Set-Cookie:H_PS_PSSID=1437_2976_2980_3090_3225; path=/; domain=.baidu.com
     */
    function setCookie($key,$value,$expire,$path,$domain){
        $this->_cookies[$key] = array(
            'value' => $value,
            'expire' => $expire,
            'path' => $path,
            'domain' => $domain,
        );
    }

}