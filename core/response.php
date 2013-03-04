<?php
/**
 * Description of response
 *
 * @author Administrator
 */
class Response {
    private $_caller;
    private $_request;
    function __construct(Array $caller,Request $request) {
        $controller = Core::ControllerFactory($caller[0], array($request,$this));
        $caller[0] = $controller;
        $this->_caller = $caller;
        $this->_request = $request;
    }
    
    function redirect($url){
        header("Location: $url");
    }
    
    function &output(){
        ob_start();
        call_user_func($this->_caller);
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }
    
}
?>