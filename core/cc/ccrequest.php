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
            if (strtolower($key) == 'set-cookie') {
                $value = explode(';', $value);
                $value = trim($value[0]);
                $value = explode('=', $value);
                $this->_cookies[$value[0]] = $value[1];
            }
        }
    }

    function getCookie($key) {
        if(empty($this->_cookies[$key])){
            return null;
        }
        return $this->_cookies[$key];
    }

    function setRequestHandler($requestHandler) {
        $this->_requestHandler = $requestHandler;
    }

    function getPath() {
//        var_dump($this->_header['path']);
        return $this->_header['path'];
    }
    
    function get($key) {
        return isset($this->_header[$key])?$this->_header[$key]:null;
    }

}