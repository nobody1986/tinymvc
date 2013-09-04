<?php
class Default_Controller extends Controller{
    function index(){
        $this->_response->write("<h1>Hello World!</h1>");
    }
    function statichandle(){
        $file_path = $this->_request->getPath();
        $file_path = TINY_APP_DIR . $file_path;
//        var_dump($file_path);
        if(!file_exists($file_path)){
            $this->_response->setCode(404);
            return;
        }
        $content = file_get_contents($file_path);
        $this->_response->setMimeTypeByPath($file_path);
        $this->_response->write($content);
    }
    
 //   function default(){
//        echo '<h1>HI</h1>';
//        $this->_response->write("Hello World!");
//    }
}
