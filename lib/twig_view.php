<?php
/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class View {
	private $_filename;
	private $_data;
	private $_obj;
	function __construct($filename, Array $data = array()) {
		Core::import('third.Twig.Autoloader');
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem(TINY_VIEW_DIR);
		$this->_obj = new Twig_Environment($loader, array('cache' => TINY_TMP_DIR,'debug' => true ));
		$this->_filename = $filename;
		$this->_data = $data;
	}

	function setData(Array $data) {
		$this -> _data = array_merge($this -> _data, $data);
	}

	function set($key, $value) {
		$this -> _data[$key] = $value;
	}

	function render() {
		if (empty($this -> _data)) {
			//            foreach($this->_data as $k => $v){
			//                $this->_obj->assign($k, $v);
			//            }
			$this -> _data = array();
		}
		//        requir$this->_datae($this->_filename);
		//        var_dump($this->_filename);
		return $this -> _obj -> render($this -> _filename,$this -> _data );
	}

}
