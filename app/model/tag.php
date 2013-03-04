<?php
/**
 * Description of blog
 *
 * @author hp1
 */
class Tag_Model extends Model{
    private function getSource(){
        if($this->_source == null){
            Core::import('lib.database');
            $this->_source = Database::singleton('tag');
        }
        return $this->_source;
    }
    
    function newTag($name){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'name' => $name,
            'created' => intval($_SERVER['REQUEST_TIME']),
        );
        $tagid = $db->insert($data);
        return $tagid;
    }
    
    function toTag($tagid,$blogid){
        $db = Database::singleton('blogtag');
        $data = array(
            'tagid' => $tagid,
            'blogid' => $blogid,
        );
        return $db->insert($data);
    }
    
    function getId($name){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'name' => $name,
        );
        $tag = $db->eq($data)->findOne();
        return $tag?intval($tag['tid']):$tag;
    }
    
    function delete($tagid){
        $db = Database::singleton('blogtag');
        $db->eq(array('tagid' => $tagid))->delete();
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->eq(array('tid' => $tagid))->delete();
    }
    
    function getCount($tagid){
        $db = Database::singleton('blogtag');
//        $db = Database::singleton('blog');
        return $db->eq(array('tagid' => $tagid))->count();
    }
    
    function getList($tagid,$page,$num = 10){
        $db = Database::singleton('blogtag');
//        $db = Database::singleton('blog');
        return $db->eq(array('tagid' => $tagid))->findAll('blogid desc',array(($page - 1) * $num,$num));
    }
    
    function getAll(){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->findAll();
    }
    
    
}

?>