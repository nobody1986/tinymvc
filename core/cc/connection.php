<?php
class Connection{
	protected $_socket ;
	function __construct($socket){
		$this->_socket = $socket;
	}	

	function read($len,$mod=PHP_BINARY_READ){
		return socket_read($this->_socket, $len,$mod); 
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