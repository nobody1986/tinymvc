<?php
/**
 * Description of blog
 *
 * @author hp1
 */
class Catalog_Model extends Model{
    private function getSource(){
        if($this->_source == null){
            Core::import('lib.database');
            $this->_source = Database::singleton('catalog');
        }
        return $this->_source;
    }
    
    function newCatalog($name){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'name' => $name,
            'created' => intval($_SERVER['REQUEST_TIME']),
        );
        $tagid = $db->insert($data);
        return $tagid;
    }
    
    function getId($name){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        $data = array(
            'name' => $name,
        );
        $tag = $db->eq($data)->findOne();
        return $tag?intval($tag['cataid']):$tag;
    }
    
    function delete($cataid){
        $db = Database::singleton('blogcata');
        $db->eq(array('cataid' => $cataid))->delete();
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->eq(array('cataid' => $cataid))->delete();
    }
    
    function getCount($cataid){
        $db = Database::singleton('blogcata');
//        $db = Database::singleton('blog');
        return $db->eq(array('cataid' => $cataid))->count();
    }
    
    function getAll(){
        $db = $this->getSource();
//        $db = Database::singleton('blog');
        return $db->findAll();
    }
    
    function getList($cataid,$page,$num = 10){
        $db = Database::singleton('blogcata');
//        $db = Database::singleton('blog');
        return $db->eq(array('cataid' => $cataid))->findAll('blogid desc',array(($page - 1) * $num,$num));
    }
    
    function toCatalog($cataid,$blogid){
        $db = Database::singleton('blogcata');
        $data = array(
            'cataid' => $cataid,
            'blogid' => $blogid,
        );
        return $db->insert($data);
    }
    
}

?>