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

    function __construct($callback) {
        require_once TINY_ROOT . 'third/weibo/Tencent.php';
        OAuth::init(self::CLIENTID, self::SECRET);
        Tencent::$debug = false;
        $this->_callback = $callback;
        if (!empty($_SESSION['t_access_token']) || (!empty($_SESSION['t_openid']) && !empty($_SESSION['t_openkey']))) {//用户已授权
            echo '<pre><h3>已授权</h3>用户信息：<br>';
            //获取用户信息
            $r = Tencent::api('user/info');
            print_r(json_decode($r, true));
            echo '</pre>';
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

}