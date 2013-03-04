<?php
/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class View {
    private $_filename ;
    private $_data;
    function __construct($filename ,Array $data = array()) {
        $this->_filename = $filename;
        $this->_data = $data;
    }
    
    function setData(Array $data){
        $this->_data = array_merge($this->_data,$data);
    }
    
    function set($key ,$value){
        $this->_data[$key] = $value;
    }
    
    function render(){
        if(!empty($this->_data)){
            extract($this->_data);
        }
        require(TINY_VIEW_DIR.$this->_filename);
    }
}

?>