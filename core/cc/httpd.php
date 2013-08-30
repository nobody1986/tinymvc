<?php



require "../request.php";
require "../response.php";
require "server.php";
require "connection.php";

class HttpServer extends Server{

	function process($c){
		$head = array();
		$method = $c->read(1024,PHP_NORMAL_READ);
		$m = substr($method,0,3);
		$m = strtolower($m);
		if( $m == "get" || $m == 'pos'){
			$method_split = explode(" ",$method);
			$head['method'] = strtolower($method_split[0]);
			$head['url'] = ($method_split[1]);
			$head['protocol'] = trim($method_split[2]);
		}
		$c->read(1024,PHP_NORMAL_READ);
		while(($line = $c->read(1024,PHP_NORMAL_READ)) ){
			$c->read(1024,PHP_NORMAL_READ);
			$line = trim($line);
			var_dump($line);
			if(empty($line)){
				break;
			}
			$line_split = explode(": ",$line);
			
			$head[$line_split[0]] = trim($line_split[1]);
		}

		var_dump($head);
		$c->write("HTTP/1.0 200 OK\r\nServer: Microsoft-IIS/5.0\r\nDate: Thu,08 Mar 200707:17:51 GMT\r\nConnection: Keep-Alive \r\nContent-Length: 5\r\nContent-Type: text/html\r\nCache-control: private\r\n\r\nHello");
		$c->close();
	}
}


$h = new HttpServer();
$h->start();