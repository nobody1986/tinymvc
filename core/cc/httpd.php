<?php
class HttpServer extends Server{
	function process($c){
		$c->write('Hello');
		$c->close();
	}
}