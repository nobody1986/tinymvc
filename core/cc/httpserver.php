<?php

class HttpServer extends Server {

    function pasrseHead($c) {
        $head = array();
        $head['client_ip'] = $c->getClientIp();
        $head['client_port'] = $c->getClientPort();
        
        $method = $c->read(1024, PHP_NORMAL_READ);
        $m = substr($method, 0, 3);
        $m = strtolower($m);
        if ($m == "get" || $m == 'pos') {
            $method_split = explode(" ", $method);
            $head['method'] = strtolower($method_split[0]);
            $url = explode('?',$method_split[1]);
            if(!empty($url[1])){
                $head['query_string'] = $url[1];
                $head['get_params'] = array();
                $args = explode('&',$url[1]);
                foreach($args as $v){
                    $v = explode('=', $v);
                    if(!empty($v[1])){
                        $head['get_params'][$v[0]] = $v[1];
                    }
                }
            }else{
                $head['query_string'] = '';
                $head['get_params'] = array();
            }
            $head['path'] = $url[0];
            
            $head['protocol'] = trim($method_split[2]);
        }
        $c->read(1024, PHP_NORMAL_READ);
        while (($line = $c->read(1024, PHP_NORMAL_READ))) {
            $c->read(1024, PHP_NORMAL_READ);
            $line = trim($line);
            if (empty($line)) {
                break;
            }
            $line_split = explode(": ", $line);
            if (isset($head[$line_split[0]])) {
                if (is_array($head[$line_split[0]])) {
                    $head[$line_split[0]] []= $line_split[1];
                } else {
                    $head[$line_split[0]] = array($head[$line_split[0]], $line_split[1]);
                }
            }else{
                $head[$line_split[0]] = trim($line_split[1]);
            }
        }
        return $head;
    }

    function process($c) {

        $head = $this->pasrseHead($c);
        $request = Core::requestFactory($head);
        $router = new Router($request->getPath());
        $response = Core::dispatch($router, $request);
        return $response->output();
    }

}

