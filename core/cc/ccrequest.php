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

    function __construct($header) {
        $this->_header = $header;
    }

    function setRequestHandler($requestHandler) {
        $this->_requestHandler = $requestHandler;
    }
    
    function getPath() {
        return $this->_header['path'];
    }

}