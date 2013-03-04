<?php
/**
 * Description of tiny_controller
 *
 * @author Administrator
 */
class Controller {
    
    protected $_request = null;
    protected $_response = null;
    protected static $_models = array();
    
    function __construct(Request $request,  Response $response) {
        $this->_request = $request;
        $this->_response = $response;
    }
    
    function model($name){
        if(!isset(self::$_models[$name])){
            $class_name = ucfirst($name).'_Model';
            if(!class_exists($class_name)){
                require_once(TINY_MODEL_DIR.$name.TINY_PHP_SUFFIX);
            }
            self::$_models[$name] = new $class_name();
        }
        return self::$_models[$name];
    }
}

?>