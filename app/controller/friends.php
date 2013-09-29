<?php
class Friends_Controller extends Controller{
    function index(){
        $_SERVER['SERVER_ADDR'] = '127.0.0.1';
        Core::import('lib.weibo.gateway');
        $q = new Weibo_Gateway('http://127.0.0.1:8080/friends/index');
        //$r = $q->getFriendsList(0,20,$_SESSION['t_openid']);
        //var_dump($r);
        $userinfo = $q->getUserInfo();
        $view = Core::viewFactory('friends.friends');
        $view->set('userinfo',$userinfo);
        $o = $view->render();
        $this->_response->write($o);
    }

}
