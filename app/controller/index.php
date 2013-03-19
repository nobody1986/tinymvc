<?php

class Index_Controller extends Controller {

    function index() {
        $view = Core::viewFactory('index');
        $model = $this->model('sifu');
        $list = $model->getList();
        $view->set('list',$list);
        $o = $view->render();
        $this->_response->write($o);
    }
}