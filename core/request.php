<?php

/**
 * Description of request
 *
 * @author Administrator
 */
class Request {

    /**
     * @string
     */
    protected $query_string;
    protected $path;

    function __construct() {
        $this->query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
        $info_parsed = array();
        $this->path = $_GET[0];
        if (isset($_GET[0])) {
            $slice = explode('/', trim($_GET[0]));
            $this->controller = empty($slice[1]) ? TINY_DEFAULT_CONTROLLER : trim($slice[1]);
            $this->action = empty($slice[2]) ? TINY_DEFAULT_ACTION : trim($slice[2]);
        } else {
            $this->controller = empty($_GET['c']) ? TINY_DEFAULT_CONTROLLER : trim($_GET['c']);
            $this->action = empty($_GET['a']) ? TINY_DEFAULT_ACTION : trim($_GET['a']);
        }
    }
    
    function getPath(){
        return $this->path;
    }

}