<?php
/**
 * Description of auth
 *
 * @author Administrator
 */
class Passport_Controller extends Controller {
	function reg() {
		$model = $this -> model('user');
		$name = $_POST['name'];
		$passwd = $_POST['passwd'];
		$uid = $model ->newUser($name, $passwd);
		if (empty($uid)) {
			die('{"success":false}');
		}
		$model -> saveToSession($uid);
		die('{"success":true}');
	}

	function update() {
		$model = $this -> model('user');
		$uid = $model->getUid();
		if(empty($uid)){
			die('{"success":false,"code":1}');
		}
		$data = array();
		$data['nickname'] = $_POST['nickname'];
		$data['email'] = $_POST['email'];
		$data['mobile'] = $_POST['mobile'];
		$data['addr'] = $_POST['addr'];
		$ret = $model -> modify($name, $data);
		if (empty($ret)) {
			die('{"success":false,"code":3}');
		}
		die('{"success":true}');
	}

	function active() {
		$model = $this -> model('user');
		$uid = $model->getUid();
		if(empty($uid)){
			die('{"success":false,"code":1}');
		}
		$data = array();
		$data['status'] = User_Model::STAT_ACTIVED;
		$ret = $model -> modify($name, $data);
		if (empty($ret)) {
			die('{"success":false,"code":3}');
		}
		die('{"success":true}');
	}

	function delete() {
		$model = $this -> model('user');
		$uid = $model->getUid();
		if(empty($uid)){
			die('{"success":false,"code":1}');
		}
		$data = array();
		$data['status'] = User_Model::STAT_DELETED;
		$ret = $model -> modify($name, $data);
		if (empty($ret)) {
			die('{"success":false,"code":3}');
		}
		die('{"success":true}');
	}

	function block() {
		$model = $this -> model('user');
		$uid = $model->getUid();
		if(empty($uid)){
			die('{"success":false,"code":1}');
		}
		$data = array();
		$data['status'] = User_Model::STAT_BLOCKED;
		$ret = $model -> modify($name, $data);
		if (empty($ret)) {
			die('{"success":false,"code":3}');
		}
		die('{"success":true}');
	}
	
	function unblock() {
		$model = $this -> model('user');
		$uid = $model->getUid();
		if(empty($uid)){
			die('{"success":false,"code":1}');
		}
		$data = array();
		$data['status'] = User_Model::STAT_NORMAL;
		$ret = $model -> modify($name, $data);
		if (empty($ret)) {
			die('{"success":false,"code":3}');
		}
		die('{"success":true}');
	}

}
