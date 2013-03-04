<?php
/**
 * Description of database
 *
 * @author Administrator
 */
class Mysql {
    private $_tablename;
    private static $_db_conn;
    function __construct($tablename) {
        $this->_tablename = $tablename;
        self::getConnection();
    }
    
    static function getConnection(){
        if(empty(self::$_db_conn)){
            $config = Core::config('database');
            $dsn = sprintf("mysql:dbname=%s;host=%s",$config['db'],$config['host']);
            self::$_db_conn =new PDO($dsn,$config['name'],$config['pass'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => sprintf('SET NAMES \'%s\'',$config['encoding']))); 
        }
        return self::$_db_conn;
    }
    
    private function _makeCondition($cond){
        $ret = '';
        $params = array();
        foreach($cond as $relation => $v){
//            if($ret != ''){
//                $ret .= $relation;
//            }
            $tmp = array();
            foreach($v as $op => $fs){
                $t = '';
                switch($op){
                    case 'gt':
                        $t = '>';
                        break;
                    case 'lt':
                        $t = '<';
                        break;
                    case 'eq':
                        $t = '=';
                        break;
                    case 'in':
                        $t = 'in';
                        break;
                }
                if(!empty($fs)){
                    foreach($fs as $k => $v){
                        if($t == 'in'){
                            $tmp []= sprintf(" %s in (%s) ",$k,  trim(str_repeat('?,', sizeof($v)),','));
                            $params += $v;
                        }else{
                            $tmp []= sprintf(" %s%s? ",$k,$t);
                            $params []= $v;
                        }
                    }
                    $ret .= implode($relation, $tmp);
                }
            }
        }
        return array($ret,$params);
    }
    
    function delete($cond){
        $sql = sprintf('delete from %s ',$this->_tablename);
        if(!empty($cond)){
            $ret = $this->_makeCondition($cond);
            $sql .= 'where '. $ret[0];
            $stmt = self::$_db_conn->prepare($sql);
            $index = 1;
            foreach($ret[1] as $v){
                $stmt->bindValue($index,$v,  is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
                ++$index;
            }
        }else{
            $stmt = self::$_db_conn->prepare($sql);
        }
        $ret = $stmt->execute();
        return $ret?$stmt->rowCount():$ret;
    }
    
    function findOne($cond){
        $sql = sprintf('select * from %s ',$this->_tablename);
        if(!empty($cond)){
            $ret = $this->_makeCondition($cond);
            $sql .= 'where '. $ret[0];
            $stmt = self::$_db_conn->prepare($sql);
            $index = 1;
            foreach($ret[1] as $v){
                $stmt->bindValue($index,$v,  is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
                ++$index;
            }
        }else{
            $stmt = self::$_db_conn->prepare($sql);
        }
        $ret = $stmt->execute();
        return $ret?$stmt->fetch(PDO::FETCH_ASSOC):$ret;
    }
    
    function count($cond){
        $sql = sprintf('select count(*) as count from %s ',$this->_tablename);
        if(!empty($cond)){
            $ret = $this->_makeCondition($cond);
            $sql .= 'where '. $ret[0];
            $stmt = self::$_db_conn->prepare($sql);
            $index = 1;
            foreach($ret[1] as $v){
                $stmt->bindValue($index,$v,  is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
                ++$index;
            }
        }else{
            $stmt = self::$_db_conn->prepare($sql);
        }
        $ret = $stmt->execute();
        if($ret){
            $ret = $stmt->fetch(PDO::FETCH_ASSOC);
            return $ret['count'];
        }else{
            return $ret;
        }
//        return $ret?$stmt->fetch(PDO::FETCH_ASSOC):$ret;
    }
    
    function findAll($cond,$order,$limit){
        $sql = sprintf('select * from %s ',$this->_tablename);
        if(!empty($cond)){
            $ret = $this->_makeCondition($cond);
            $sql .= 'where '. $ret[0];
            if(!empty($order)){
                $sql .= ' order by '.$order;
            }
            if(!empty($limit)){
                $sql .= sprintf(' limit %d,%d',$limit[0],$limit[1]);
            }
            $stmt = self::$_db_conn->prepare($sql);
            $index = 1;
            foreach($ret[1] as $v){
                $stmt->bindValue($index,$v,  is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
                ++$index;
            }
        }else{
            $stmt = self::$_db_conn->prepare($sql);
        }
        $ret = $stmt->execute();
        return $ret?$stmt->fetchAll(PDO::FETCH_ASSOC):$ret;
    }
    
    function insert($data){
        $st = trim(str_repeat('?,', sizeof($data)),',');
        $sql = sprintf('insert into %s (%s) values (%s)',$this->_tablename,  
                implode(',', array_keys($data)),$st);
        $stmt = self::$_db_conn->prepare($sql);
        $index = 1;
        foreach($data as $v){
//            $stmt->bindParam($index,$v,is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
            $stmt->bindValue($index,$v,is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
            //天杀的 bindParam
//            if(is_int($v)){
//                $stmt->bindValue($index,$v,PDO::PARAM_INT);
//            }else{
//                $stmt->bindValue($index,$v,PDO::PARAM_STR);
//            }
            ++$index;
        }
        $ret = $stmt->execute();
        return $ret?self::$_db_conn->lastInsertId():$ret;
    }
    
    function update($cond,$data){
        $sql = sprintf('update %s set ',$this->_tablename);
        $tmp = array();
        foreach($data as $v){
            $tmp []= sprintf('%s = ?');
        }
        $sql .= implode(',',$tmp);
        
        $params = array_values($data);
        if(!empty($cond)){
            $ret = $this->_makeCondition($cond);
            $sql .= 'where '. $ret[0];
            $stmt = self::$_db_conn->prepare($sql);
            $params += $ret[1];
        }else{
            $stmt = self::$_db_conn->prepare($sql);
            
        }
        $index = 1;
        foreach($params as $v){
            $stmt->bindValue($index,$v,  is_int($v)?PDO::PARAM_INT:PDO::PARAM_STR);
            ++$index;
        }
        $ret = $stmt->execute();
        return $ret?$stmt->rowCount():$ret;
    }
    
    function beginTransaction(){
        return self::$_db_conn->beginTransaction();
    }
    
    function commit(){
        return self::$_db_conn->commit();
    }
    
    function rollBack(){
        return self::$_db_conn->rollBack();
    }
}

?>