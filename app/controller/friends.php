<?php
class Friends_Controller extends Controller{
    function index(){
        Core::import('lib.weibo.qq');
        $q = new Weibo_Qq('http://127.0.0.1:8080/friends/index');

    }

}
