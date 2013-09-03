<?php

class HttpServer extends Server {

    function pasrseHead($c) {
        $head = array();
        $method = $c->read(1024, PHP_NORMAL_READ);
        $m = substr($method, 0, 3);
        $m = strtolower($m);
        if ($m == "get" || $m == 'pos') {
            $method_split = explode(" ", $method);
            $head['method'] = strtolower($method_split[0]);
            $head['path'] = ($method_split[1]);
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

            $head[$line_split[0]] = trim($line_split[1]);
        }
        return $head;
    }

    function process($c) {

        $head = $this->pasrseHead($c);
        $request = Core::requestFactory($head);
        $router = new Router($request->getPath());
        $response = Core::dispatch($router, $request);

        $c->write($response->output());
        $c->close();
    }

}

