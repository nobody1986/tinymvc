﻿<?php

class Friends_Controller extends Controller {

    function index() {
        Core::import('lib.weibo.qq');
        $qq = new Weibo_Qq($this->_request,$this->_response,'http://127.0.0.1:8080/friends/index');
    }


}
