<?php
/**
 * Description of auth
 *
 * @author Administrator
 */
class Auth_Controller extends Controller {
    function login(){
        $model = $this->model('user');
        $name = $_POST['name'];
        $passwd = $_POST['passwd'];
        $user = $model->checkPasswd($name,$passwd);
        if(empty($user)){
            die('{"success":false}');
        }
        $model->saveToSession($user['uid']);
        die('{"success":true}');
    }
    
    function logout(){
        $model = $this->model('user');
        $name = $_POST['name'];
        $passwd = $_POST['passwd'];
        $user = $model->checkPasswd($name,$passwd);
        if(empty($user)){
            die('{"success:false"}');
        }
        $model->saveToSession($user['uid']);
        die('{"success:true"}');
    }
}

?>
