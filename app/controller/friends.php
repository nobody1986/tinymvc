<?php
class Friends_Controller extends Controller{
    function index(){
        $_SERVER['SERVER_ADDR'] = '127.0.0.1';
        Core::import('lib.weibo.gateway');
        $q = new Weibo_Gateway('http://127.0.0.1:8080/friends/index');
        $r = $q->getUserInfo();
        var_dump($r);
    }

}
