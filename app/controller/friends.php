<?php

class Friends_Controller extends Controller {

    function index() {
        Core::import('lib.weibo.qq');
        $qq = Weibo_Qq($this->_request,$this->_response,'/friends/index');
    }


}
