<?php

/**
 * Description of tiny_view
 *
 * @author Administrator
 */
class Weibo_Qq {

    const CLIENTID = '801419160';
    const SECRET = 'efb1b5fdb0ec6d3d2e064c5cc1783016';

    private $_response = null;
    private $_request = null;
    private $_callback = null;

    function __construct($request, $response,$callback) {
        require_once TINY_ROOT . 'third/qqweibo/Tencent.php';
        OAuth::init(self::CLIENTID, self::SECRET);
        Tencent::$debug = false;
        $this->_response = $response;
        $this->_request = $request;
        $this->_callback = $callback;
        $t_access_token = $this->_request->getCookie('t_access_token');
        $t_openid = $this->_request->getCookie('t_openid');
        $t_openkey = $this->_request->getCookie('t_openkey');

        if ($t_access_token || ($t_openid && $t_openkey)) {//用户已授权
            echo '<pre><h3>已授权</h3>用户信息：<br>';
            //获取用户信息
            $session =  array(
                't_access_token' => $t_access_token,
                't_openid' => $t_openid,
                't_openkey' => $t_openkey,
                'client_ip' => $this->_request->getClientIp(),
                'server_ip' => $this->_request->getServerIp(),
            );
            $r = Tencent::api('user/info',$session);
            print_r(json_decode($r, true));
            echo '</pre>';
            // 部分接口的调用示例
            /**
             * 发表图片微博
             * pic参数后跟图片的路径,以表单形式上传的为 : $_FILES['pic']['tmp_name']
             * 服务器目录下的文件为: dirname(__FILE__).'/logo.png'
             * /
              $params = array(
              'content' => '测试发表一条图片微博'
              );
              $multi = array('pic' => dirname(__FILE__).'/logo.png');
              $r = Tencent::api('t/add_pic', $params, 'POST', $multi);
              echo $r;

              /**
             * 发表图片微博
             * 如果图片地址为网络上的一个可用链接
             * 则使用add_pic_url接口
             * /
              $params = array(
              'content' => '以链接形式发表一条图片微博',
              'pic_url' => 'http://mat1.gtimg.com/www/iskin960/qqcomlogo.png'
              );
              $r = Tencent::api('t/add_pic_url', $params, 'POST');
              echo $r;
             */
        } else {//未授权
            $callback = $this->_callback; //回调url
            $code = $this->_request->get('code');
            if ($code) {//已获得code
                $openid = $this->_request->get('openid');
                $openkey = $this->_request->get('openkey');
                //获取授权token
                $url = OAuth::getAccessToken($code, $callback);
                $r = Http::request($url);
                parse_str($r, $out);
                //存储授权数据
                if ($out['access_token']) {
//                    $_SESSION['t_access_token'] = $out['access_token'];
//                    $_SESSION['t_refresh_token'] = $out['refresh_token'];
//                    $_SESSION['t_expire_in'] = $out['expires_in'];
//                    $_SESSION['t_code'] = $code;
//                    $_SESSION['t_openid'] = $openid;
//                    $_SESSION['t_openkey'] = $openkey;
                    
                    $this->_response->setCookie('t_access_token',$out['access_token']);
                    $this->_response->setCookie('t_refresh_token',$out['refresh_token']);
                    $this->_response->setCookie('t_expire_in',$out['expires_in']);
                    $this->_response->setCookie('t_code',$code);
                    $this->_response->setCookie('t_openid',$openid);
                    $this->_response->setCookie('t_openkey',$openkey);

                    $session =  array(
                        't_openid' => $openid,
                        't_openkey' => $openkey,
                    );
                    //验证授权
                    $r = OAuth::checkOAuthValid($session);
                    if ($r) {
//                        header('Location: ' . $callback); //刷新页面
                        $this->_response->redirect($callback);
                    } else {
                        $this->_response->write('<h3>授权失败,请重试</h3>');
                    }
                } else {
                    exit($r);
                }
            } else {//获取授权code
                $openid = $this->_request->get('openid');
                $openkey = $this->_request->get('openkey');
                if ($openid && $openkey) {//应用频道
                    $this->_response->setCookie('t_openid',$openid);
                    $this->_response->setCookie('t_openkey',$openkey);
                    $session =  array(
                        't_openid' => $openid,
                        't_openkey' => $openkey,
                    );
                    //验证授权
                    $r = OAuth::checkOAuthValid($session);
                    if ($r) {
                        $this->_response->redirect($callback);
                    } else {
                        $this->_response->write('<h3>授权失败,请重试</h3>');
                    }
                } else {
                    $url = OAuth::getAuthorizeURL($callback);
                    $this->_response->redirect($url);
                }
            }
        }
    }

}

