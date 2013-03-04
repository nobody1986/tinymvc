<?php
/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class View {
    private $_filename ;
    private $_data;
    private $_obj;
    function __construct($filename ,Array $data = array()) {
        Core::import('third.rain');
        $this->_filename = $filename;
        $this->_data = $data;
        RainTPL::$tpl_dir = TINY_VIEW_DIR;
        RainTPL::$cache_dir = TINY_TMP_DIR;
        RainTPL::$tpl_ext = TINY_TEMPLATE_SUFFIX;
        RainTPL::$path_replace = false;
        $this->_obj = new RainTPL();
    }
    
    function setData(Array $data){
        $this->_data = array_merge($this->_data,$data);
    }
    
    function set($key ,$value){
        $this->_data[$key] = $value;
    }
    
    function render(){
        if(!empty($this->_data)){
//            foreach($this->_data as $k => $v){
//                $this->_obj->assign($k, $v);
//            }
            $this->_obj->assign($this->_data);
        }
//        requir$this->_datae($this->_filename);
//        var_dump($this->_filename);
        $this->_obj->draw($this->_filename);
    }
}

?>