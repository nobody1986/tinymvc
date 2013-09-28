<?php

/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class Weibo_Qq {

    const CLIENTID = '801419160';
    const SECRET = 'efb1b5fdb0ec6d3d2e064c5cc1783016';

    private $_callback = null;

    const RET_OK = 0;

    function __construct($callback) {
        require_once TINY_ROOT . 'third/weibo/Tencent.php';
        OAuth::init(self::CLIENTID, self::SECRET);
        Tencent::$debug = false;
        $this->_callback = $callback;
var_dump($_SESSION);
        if (!empty($_SESSION['t_access_token']) || (!empty($_SESSION['t_openid']) && !empty($_SESSION['t_openkey']))) {//用户已授权
            //验证授权
        } else {//未授权
            $callback = $this->_callback; //'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];//回调url
            if (!empty($_GET['code'])) {//已获得code
                $code = $_GET['code'];
                $openid = $_GET['openid'];
                $openkey = $_GET['openkey'];
                //获取授权token
                $url = OAuth::getAccessToken($code, $callback);
                $r = Http::request($url);
                parse_str($r, $out);
                //存储授权数据
                if ($out['access_token']) {
                    $_SESSION['t_access_token'] = $out['access_token'];
                    $_SESSION['t_refresh_token'] = $out['refresh_token'];
                    $_SESSION['t_expire_in'] = $out['expires_in'];
                    $_SESSION['t_code'] = $code;
                    $_SESSION['t_openid'] = $openid;
                    $_SESSION['t_openkey'] = $openkey;

                    //验证授权
                    $r = OAuth::checkOAuthValid();
                    var_dump($r);
                    die();
                    if ($r) {
                        header('Location: ' . $callback); //刷新页面
                    } else {
                        exit('<h3>授权失败,请重试</h3>');
                    }
                } else {
                    exit($r);
                }
            } else {//获取授权code
                if (!empty($_GET['openid']) && !empty($_GET['openkey'])) {//应用频道
                    $_SESSION['t_openid'] = $_GET['openid'];
                    $_SESSION['t_openkey'] = $_GET['openkey'];
                    //验证授权
                    $r = OAuth::checkOAuthValid();
                    if ($r) {
                        header('Location: ' . $callback); //刷新页面
                    } else {
                        exit('<h3>授权失败,请重试</h3>');
                    }
                } else {
                    $url = OAuth::getAuthorizeURL($callback);
                    header('Location: ' . $url);
                }
            }
        }
    }

    function getUserInfo() {
        $ret = Tencent::api('friends/add');
        var_dump($ret);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK?$ret['data']:false;
    }

    function getFanList($pos,$num,$install=0,$sex=0) {
        $param =  array();
        $param['startindex'] = $pos;
        $param['reqnum'] = $num;
        $param['install'] = $install;
        $param['sex'] = $sex;
        $ret = Tencent::api('friends/fanslist', $param);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK?$ret['data']:false;
    }

    function getFollowList($pos,$num,$install=0) {
        $param =  array();
        $param['startindex'] = $pos;
        $param['reqnum'] = $num;
        $param['install'] = $install;
        $ret = Tencent::api('friends/idollist', $param);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK?$ret['data']:false;
    }

    function getFriendsList($pos,$num,$install=0) {
        $param =  array();
        $param['startindex'] = $pos;
        $param['reqnum'] = $num;
        $param['install'] = $install;
        $ret = Tencent::api('friends/mutual_list', $param);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK?$ret['data']:false;
    }

    function getBlackList($pos,$num) {
        $param =  array();
        $param['startindex'] = $pos;
        $param['reqnum'] = $num;
        $ret = Tencent::api('friends/blacklist', $param);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK?$ret['data']:false;
    }

    function post($content, $img = null) {
        $param = array();
        $param['content'] = $content;
        $param['clientip'] = Common::getClientIp();


        if (empty($img)) {
            $ret = Tencent::api('t/add', $param, 'POST');
        } else {
            $multi = array('pic' => $img);
            $ret = Tencent::api('t/add_pic', $param, 'POST', $multi);
        }
        $ret = json_decode($ret, true);
        if ($ret['ret'] == self::RET_OK) {
            return $ret['data']['id'];
        } else {
            return false;
        }
    }

    function follow($openids, $names = array()) {
        $param = array();
        if (!empty($openids)) {
            $param['fopenids'] = implode('_', $openids);
        }
        if (!empty($names)) {
            $param['name'] = implode('_', $names);
        }
        $ret = Tencent::api('friends/add', $param);
        $ret = json_decode($ret, true);
        return $ret['ret'] == self::RET_OK;
    }

    function unfollow() {
        
    }

    function addToBlack() {
        
    }

    function removeFromBlack() {
        
    }

}