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
    private $_url = null;
    
    function __construct($url) {
        $this->_url = $url;
        $this->parseHeader();
    }

    
     function parseHeader() {
         global $Routers;
         if(!empty($Routers)){
             foreach($Routers as $key => $item){
                 if(preg_match("#{$key}#i", $this->_url)){
                     $this->_controller = $item[0];
                     $this->_action = $item[1];
                     return;
                 }
             }
         }
        $path = $this->_url;
        $slice = explode('/', trim($path,'/'));
        $this->_controller = empty($slice[0]) ? TINY_DEFAULT_CONTROLLER : trim($slice[0]);
        $this->_action = empty($slice[1]) ? TINY_DEFAULT_ACTION : trim($slice[1]);
    }
    
    function getInstance($request = null){
        if(empty($this->_instance)){
            $this->_instance = new $this->_controller(empty($request)?Tiny_Core::$TINY_CU_REQUEST:$request);
        }
        return $this->_instance;
    }
    
    function getCaller() {
        return array($this->_controller,  $this->_action);
    }

}
