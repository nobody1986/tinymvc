<?php

/**
 * Socket Server
 */
class Server {

    protected $_options = array(
        'host' => '0.0.0.0',
        'port' => 80,
    );

    function __construct($options = array()) {
        foreach ($options as $key => $value) {
            $this->_options[$key] = $value;
        }
    }

    function start() {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        //socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($socket, $this->_options['host'], $this->_options['port']);
        socket_listen($socket);
        socket_set_nonblock($socket);
 
        $connections =  array($socket);
        $output = array();
        $close = array();
        $objs = array();

        while (true)
        {
            $readfds = $connections;

            $writefds = array();
         
            //选择一个连接，获取读、写连接通道
            $t = 0;
            if (socket_select($readfds, $writefds, $e, $t) < 1)
            {   
                continue;
            }
                foreach ($readfds as $rfd)
                {
                    //如果是当前服务端的监听连接
                    if ($rfd == $socket)
                    {
                        //接受客户端连接
                        $newconn = socket_accept($socket);
                        $i = (int)$newconn;
                        $reject = '';          
                        //将当前客户端连接放如socket_select选择
                        $connections[$i] = $newconn;
                        //输入的连接资源缓存容器
                        //$writefds[$i] = $newconn;               
                        //连接不正常
                        if ($reject)
                        {                  
                            $close[$i] = true;
                        }
                        else
                        {             
                        }          
                        $key = array_search($socket, $readfds);
                        unset($readfds[$key]);
                        //continue;
                    }else{
                        $i = (int)$rfd;
                        $c = new Connection($rfd);
                        $output[$i] = $this->process($c);
                        $objs[$i] = $c;
                        $c->write($output[$i]);
                        $c->close();
                        $objs[$i] = null;
                        unset($connections[$i]);
                        //socket_getpeername($rfd, $ip);
                        //echo "New client connected: {$ip} \n";
                    }
                    //客户端连接
                    
                   
                    
                }
                //echo sizeof($connections);
                //echo sizeof($readfds);
                //echo sizeof($writefds);
                //echo sizeof($writefds);
                /*
                if(!empty($writefds)){
                    foreach ($writefds as $wfd){
                        $i = (int)$wfd;
                        $c = $objs[$i];
                        $c->write($output[$i]);
                        $c->close();
                        $objs[$i] = null;
                        unset($connections[$i]);
                    }
                }
                */
                //socket_set_nonblock($socket);
                //while (true) {
                //    if (($newc = socket_accept($socket)) !== false) {
                //        $c = new Connection($newc);
                //        $this->process($c);
                //    }
                //}
            //}
        }
    }

    function process($c) {
        $c->write('Hello');
        $c->close();
    }

    function __destruct() {
        
    }

}