<?php
/**
 * Description of database
 *
 * @author Administrator
 */
class Database {
    private $_tablename;
    private $_db_driver;
    private $_db_obj;
    private $_cond;
    private $_cond_relation;
    
    private static $_objs = array();
    
    private function __construct($tablename) {
        $this->_tablename = $tablename;
        if(!defined('DB_DRIVER')){
            $this->_db_driver = 'mysql';
        }else{
            $this->_db_driver = DB_DRIVER;
        }
        $class_name = ucfirst($this->_db_driver);
        if(!class_exists($class_name)){
            Core::import('lib.driver.'.$this->_db_driver);
        }
        $this->_db_obj = new $class_name($tablename);
        $this->_cond = array(
            'and' => array(
                'gt' => array(),
                'lt' => array(),
                'eq' => array(),
                'in' => array(),
            ),
            'or' => array(
                'gt' => array(),
                'lt' => array(),
                'eq' => array(),
                'in' => array(),
            ),
        );
        $this->_cond_relation = 'and';
    }
    
    private function clearCond(){
        $this->_cond = array(
            'and' => array(
                'gt' => array(),
                'lt' => array(),
                'eq' => array(),
                'in' => array(),
            ),
            'or' => array(
                'gt' => array(),
                'lt' => array(),
                'eq' => array(),
                'in' => array(),
            ),
        );
    }
    
    /**
     * @return Database
     */
    static function singleton($tablename){
        if(empty(self::$_objs[$tablename])){
            self::$_objs[$tablename] = new Database($tablename);
        }
        return self::$_objs[$tablename];
    }
    
    function delete(){
        $ret = $this->_db_obj->delete($this->_cond);
        $this->clearCond();
        return $ret;
    }
    
    function findOne(){
        $ret = $this->_db_obj->findOne($this->_cond);
        $this->clearCond();
        return $ret;
    }
    
    function count(){
        $ret = $this->_db_obj->count($this->_cond);
        $this->clearCond();
        return $ret;
    }
    
    function findAll($order = null,$limit = null){
        $ret = $this->_db_obj->findAll($this->_cond,$order,$limit);
        $this->clearCond();
        return $ret;
    }
    
    function insert($data){
        $ret =  $this->_db_obj->insert($data);
        $this->clearCond();
        return $ret;
    }
    
    function update($data){
        $ret = $this->_db_obj->update($this->_cond,$data);
        $this->clearCond();
        return $ret;
    }
    
    function beginTransaction(){
        return $this->_db_obj->beginTransaction();
    }
    
    function commit(){
        return $this->_db_obj->commit();
    }
    
    function rollBack(){
        return $this->_db_obj->rollback();
    }
    
    function gt($k,$v = null){
        if($v === null){
            $this->_cond[$this->_cond_relation]['gt'] = $k + $this->_cond[$this->_cond_relation]['gt'];
        }else{
            $this->_cond[$this->_cond_relation]['gt'][$k] = $v;
        }
        return $this;
    }
    
    function lt($k,$v = null){
        if($v === null){
            $this->_cond[$this->_cond_relation]['lt'] = $k + $this->_cond[$this->_cond_relation]['lt'];
        }else{
            $this->_cond[$this->_cond_relation]['lt'][$k] = $v;
        }
        return $this;
    }
    
    function eq($k,$v = null){
        if($v === null){
            $this->_cond[$this->_cond_relation]['eq'] = $k + $this->_cond[$this->_cond_relation]['eq'];
        }else{
            $this->_cond[$this->_cond_relation]['eq'][$k] = $v;
        }
        return $this;
    }
    
    function in($k,$v){
        $this->_cond[$this->_cond_relation]['in'][$k] = $v;
        return $this;
    }
    
    function ander(){
        $this->_cond_relation = 'and';
    }
    
    function orer(){
        $this->_cond_relation = 'or';
    }
}

?>