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
    protected $_requestHandler;
    protected $_header;
    protected $_cookies;

    function __construct($header) {
        $this->_header = $header;
        $this->_cookies = array();
        foreach ($header as $key => $value) {
            if (strtolower($key) == 'cookie') {
                $value = explode(';', $value);
                foreach($value as $l){
                    $l = explode('=', $l);
                    $l[0] = trim($l[0]);
                    $this->_cookies[$l[0]] = trim($l[1]);
                }
            }
        }
    }

    function getCookie($key) {
        if(empty($this->_cookies[$key])){
            return null;
        }
        return $this->_cookies[$key];
    }
    
    function getClientIp() {
        return $this->_header['client_ip'];
    }
    
    function getServerIp() {
        return '127.0.0.1';
    }

    function setRequestHandler($requestHandler) {
        $this->_requestHandler = $requestHandler;
    }

    function getPath() {
//        var_dump($this->_header['path']);
        return $this->_header['path'];
    }
    
    function get($key) {
        return isset($this->_header['get_params'][$key])?$this->_header['get_params'][$key]:null;
    }

    function post($key) {
        return isset($this->_header['post_params'][$key])?$this->_header['post_params'][$key]:null;
    }

}