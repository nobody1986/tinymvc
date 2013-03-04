<?php
/**
 * Description of blog
 *
 * @author hp1
 */
class Blog_Model extends Model{
    private function getSource(){
        if($this->_source == null){
            Core::import('lib.database');
            $this->_source = Database::singleton('blog');
        }
        return $this->_source;
    }
    
    /*
CREATE  TABLE `user` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(32) NOT NULL ,
  `passwd` VARCHAR(32) NOT NULL ,
  `created` INT UNSIGNED NOT NULL ,
  `lastlogin` INT UNSIGNED NOT NULL ,
  `disabled` TINYINT UNSIGNED NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `mobile` VARCHAR(15) NOT NULL ,
  `addr` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`uid`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
     * 
     * 
CREATE  TABLE `blog` (
  `blogid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` INT UNSIGNED NOT NULL ,
  `lastmodify` INT UNSIGNED NOT NULL ,
  `uid` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`blogid`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


CREATE  TABLE `test`.`tag` (
  `tid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `created` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tid`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
     * 
CREATE  TABLE `test`.`catalog` (
  `cataid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `created` INT NOT NULL ,
  PRIMARY KEY (`cataid`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
     * 
     * 
CREATE  TABLE `test`.`blogcata` (
  `blogid` INT UNSIGNED NOT NULL ,
  `cataid` INT UNSIGNED NOT NULL )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


CREATE  TABLE `test`.`blogtag` (
  `blogid` INT UNSIGNED NOT NULL ,
  `tagid` INT UNSIGNED NOT NULL )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
     */
    
    
    function post($uid,$title,$content){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'title' => $title,
            'content' => $content,
            'created' => intval($_SERVER['REQUEST_TIME']),
            'lastmodify' => 0,
            'uid' => $uid,
        );
        $blogid = $db->insert($data);
        return $blogid;
    }
    
    function delete($uid,$blogid){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->eq(array('uid' => $uid,'blogid' => $blogid))->delete();
    }
    
    function modify($uid,$blogid,$title,$content){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'title' => $title,
            'content' => $content,
            'lastmodify' => intval($_SERVER['REQUEST_TIME']),
        );
        return $db->eq(array('blogid' => $blogid,'uid' => $uid))->update($data);
    }
    
    function getOne($uid,$blogid){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->eq(array('blogid' => $blogid,'uid' => $uid))->findOne();
    }
    
    function getList($uid,$page,$num = 10){
        $db = $this->getSource();   
//        $db = Database::singleton('blog');
        return $db->eq(array('uid' => $uid))->findAll('blogid desc',array(($page - 1) * $num,$num));
    }
    
    function getFromIds($blogids){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->in('blogid',$blogids)->findAll('blogid desc');
    }
    
    function count($uid){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->eq(array('uid' => $uid))->count();
    }
    
}

?>