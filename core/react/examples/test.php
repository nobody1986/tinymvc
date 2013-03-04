<?php
require '../vendor/autoload.php';
$stack = new React\Espresso\Stack(function ($request, $response) {
    $response->writeHead(200, array('Content-Type' => 'text/plain'));
    $response->end("Hello World\n");
});
echo "Server running at http://127.0.0.1:1337\n";
$stack->listen(1337);

