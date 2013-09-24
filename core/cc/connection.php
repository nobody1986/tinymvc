<?php

class Connection {

    protected $_socket;
    protected $_port;
    protected $_ip;

    function __construct($socket) {
        $this->_socket = $socket;
        socket_getpeername($socket, $ip, $port);
        $this->_ip = $ip;
        $this->_port = $port;
    }

    function read($len, $mod = PHP_BINARY_READ) {
        return socket_read($this->_socket, $len, $mod);
    }

    function write($str) {
        return socket_write($this->_socket, $str);
    }

    function close() {
        socket_close($this->_socket);
    }
    function getClientIp() {
        return $this->_ip;
    }
    function getClientPort() {
       return $this->_port; 
    }

    function __destruct() {
        //socket_close($this->_socket);
    }

}