<?php

/**
 * Socket Server
 */
class Server {

    protected $_options = array(
        'host' => '0.0.0.0',
        'port' => 8080,
    );

    function __construct($options = array()) {
        foreach ($options as $key => $value) {
            $this->_options[$key] = $value;
        }
    }

    function start() {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($socket, $this->_options['host'], $this->_options['port']);
        socket_listen($socket);
        //socket_set_nonblock($socket);
        while (true) {
            if (($newc = socket_accept($socket)) !== false) {
                $c = new Connection($newc);
                $this->process($c);
            }
        }
    }

    function process($c) {
        $c->write('Hello');
        $c->close();
    }

    function __destruct() {
        
    }

}