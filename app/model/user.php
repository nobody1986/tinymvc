<?php
/**
 * Description of blog
 *
 * @author hp1
 */
class User_Model extends Model{
	CONST STAT_NORMAL = 0;
	CONST STAT_ACTIVED = 1;
	CONST STAT_DELETED = 100;
	CONST STAT_BLOCKED = 200;
	
    private function getSource(){
        if($this->_source == null){
            Core::import('lib.database');
            $this->_source = Database::singleton('user');
        }
        return $this->_source;
    }
    
    function newUser($name,$passwd){
        $db = $this->getSource();
        $data = array(
            'name' => $name,
            'passwd' => md5($passwd),
            'created' => intval($_SERVER['REQUEST_TIME']),
        );
        $userid = $db->insert($data);
        return $userid;
    }
    
    function getId($name){
        $db = $this->getSource();
        $data = array(
            'name' => $name,
        );
        $tag = $db->eq($data)->findOne();
        return $tag?intval($tag['uid']):$tag;
    }
    
    function delete($uid){
        $db = $this->getSource();
        return $db->eq(array('uid' => $uid))->delete();
    }
    
    function getCount($cataid){
        $db = $this->getSource();
        return $db->count();
    }
    
    function getAll(){
        $db = $this->getSource();
        return $db->findAll();
    }
    
    function getList($page,$num = 10){
        $db = $this->getSource();
        return $db->findAll('uid desc',array(($page - 1) * $num,$num));
    }
    
    function checkPasswd($name,$passwd){
        $db = $this->getSource();
        $data = array(
            'name' => $name,
            'passwd' => md5($passwd),
        );
        $ret = $db->eq($data)->findOne();
        if($ret){
            $data = array(
                'lastlogin' => intval($_SERVER['REQUEST_TIME']),
            );
            $this->modify(intval($ret['uid']), $data);
        }
        return $ret;
    }
    
    function modify($uid,$data){
        $db = $this->getSource();
        return $db->eq(array('uid' => $uid))->update($data);
    }
    
    function isLogined(){
        return !empty($_SESSION['uid']);
    }
    
    function getUid(){
        return empty($_SESSION['uid'])?null:intval($_SESSION['uid']);
    }
    
    function saveToSession($uid){
        $_SESSION['uid'] = $uid;
    }
	function clearSession($uid){
        unset($_SESSION['uid']);
    }
}

?>