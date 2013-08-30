<?php
/**
 * Description of router
 *
 * @author Administrator
 */
class Router {
    private $_instance = null;
    private $_controller = null;
    private $_action = null;
    function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    function getInstance($request = null){
        if(empty($this->_instance)){
            $this->_instance = new $this->_controller(empty($request)?Tiny_Core::$TINY_CU_REQUEST:$request);
        }
        return $this->_instance;
    }
    
    function getCaller() {
//        $instance = $this->getInstance();
        return array($this->_controller,  $this->_action);
    }

}
