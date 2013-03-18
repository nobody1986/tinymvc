<?php
/**
 * Description of blog
 *
 * @author hp1
 */
class Sifu_Model extends Model{
    private function getSource(){
        if($this->_source == null){
            Core::import('lib.database');
            $this->_source = Database::singleton('sifu');
        }
        return $this->_source;
    }
    
    function newSifu($data){
        $db = $this->getSource();
        $tagid = $db->insert($data);
        return $tagid;
    }
    
    function delete($cataid){
        $db = $this->getSource();
        return $db->eq(array('cataid' => $cataid))->delete();
    }
    
    function getList($page,$num = 10){
        $db = $this->getSource();
        return $db->findAll('id desc',array(($page - 1) * $num,$num));
    }
    
    
}