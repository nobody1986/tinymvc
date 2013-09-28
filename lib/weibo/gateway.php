<?php

/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class Weibo_Gateway {


    private $_callback = null;
    private $_weibo = null;

    function __construct($callback) {
        switch (WEIBO){
            case 'qq':
                Core::import('lib.weibo.qq');
                $this->_weibo = new Weibo_Qq($callback);
                break;
        }
        $this->_callback = $callback;

    }
    
    function getUserInfo(){
        return $this->_weibo->getUserInfo();
    }
    function getFanList($pos,$num,$install=0,$sex=0){
        return $this->_weibo->getFanList($pos,$num,$install,$sex);
    }
    function getFollowList($pos,$num,$install=0){
        return $this->_weibo->getFollowList($pos,$num,$install);
    }
    function getFriendsList($pos,$num,$install=0){
        return $this->_weibo->getFriendsList($pos,$num,$install);
    }
    function getBlackList($pos,$num){
        return $this->_weibo->getBlackList($pos,$num);
    }
    
    function post($content, $img = null){
        return $this->_weibo->post($content,$img);
    }
    function follow($openids,$names = array()){
        return $this->_weibo->follow($openids,$names);
    }
    function unfollow(){}
    function addToBlack(){}
    function removeFromBlack(){}

}