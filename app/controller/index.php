<?php

class Index_Controller extends Controller {

    function index() {
        $view = Core::viewFactory('blog.post');
        $view->set('login_url', "/index.php?c=auth&a=login");
        $view->set('nickname', 'ssss');
        $view->set('addr', 'zzzz');
        $view->set('post_url', '/index.php?c=blog&a=post');
        $o = $view->render();
        $this->_response->write($o);
    }

}