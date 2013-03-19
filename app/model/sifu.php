<?php
/**
 * Description of blog
 *名称IP开机时间[月/日/时]线路详细版本介绍客服QQ主页地址
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
    
    function getList($page=1,$num = 100){
        $db = $this->getSource();
        return $db->findAll('id desc',array(($page - 1) * $num,$num));
    }
}
