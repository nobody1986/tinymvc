<?php
class Connection{
	protected $_socket ;
	function __construct($socket){
		$this->_socket = $socket;
	}	

	function read($len){
		return socket_read($this->_socket, $len); 
	}

	function write($str){
		return socket_write($this->_socket, $str);
	}

	
	function close(){
		socket_close($this->_socket);
	}


	
	function __destruct(){
		//socket_close($this->_socket);
	}
}