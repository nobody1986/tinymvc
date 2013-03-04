<?php
class Default_Controller extends Controller{
    function index(){
        $this->_response->write("<h1>Hello World!</h1>");
    }
    
 //   function default(){
//        echo '<h1>HI</h1>';
//        $this->_response->write("Hello World!");
//    }
}
