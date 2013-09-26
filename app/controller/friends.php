<?php
class Friends_Controller extends Controller{
    function index(){
        $_SERVER['SERVER_ADDR'] = '127.0.0.1';
        Core::import('lib.weibo.qq');
        $q = new Weibo_Qq('http://127.0.0.1:8080/friends/index');

    }

}
