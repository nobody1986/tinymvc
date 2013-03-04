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
        Core::import('third.xtemplate');
        $this->_filename = $filename;
        $this->_data = $data;
        $this->_obj = new XTemplate($filename);
    }
    
    function setData(Array $data){
        $this->_data = array_merge($this->_data,$data);
    }
    
    function set($key ,$value){
        $this->_data[$key] = $value;
    }
    
    function render(){
        if(!empty($this->_data)){
            foreach($this->_data as $k => $v){
                $this->_obj->assign($k, $v);
            }
        }
        require($this->_filename);
    }
}

?>