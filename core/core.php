<?php

/**
 * Description of core
 *
 * @author Administrator
 */
class Core {

    static $TINY_IMPORTED = array();
    static $TINY_ROUTER = array();
    static $TINY_CU_ROUTER = null;
    static $TINY_CU_REQUEST = null;
    static $TINY_CU_RESPONSE = null;
    static $TINY_CONTROLLER = array();
    static $TINY_VIEW = array();
    static $TINY_IMPORT_PATH = array(
        TINY_APP_DIR,
        TINY_ROOT,
    );
    
    static $TINY_CONFIG = array();

    static function init() {
        self::setIncludePath();
        $query_string = $_SERVER['QUERY_STRING'];
        $info_parsed = array();
        if (isset($_GET[0])) {
            $slice = explode('/', trim($_GET[0]));
            $info_parsed['controller'] = empty($slice[1]) ? TINY_DEFAULT_CONTROLLER : trim($slice[1]);
            $info_parsed['action'] = empty($slice[2]) ? TINY_DEFAULT_ACTION : trim($slice[2]);
        } else {
            $info_parsed['controller'] = empty($_GET['c']) ? TINY_DEFAULT_CONTROLLER : trim($_GET['c']);
            $info_parsed['action'] = empty($_GET['a']) ? TINY_DEFAULT_ACTION : trim($_GET['a']);
        }
        self::$TINY_CU_ROUTER = self::routerFactory($info_parsed);
        self::$TINY_CU_REQUEST = self::requestFactory();
    }

    static function requestFactory() {
        //web request
        return (new Request());
    }
    
    static function viewFactory($path = '',Array $data = array()) {
        if (!isset(self::$TINY_VIEW[$path])) {
            $fileName = str_replace('.',DIRECTORY_SEPARATOR,$path).TINY_TEMPLATE_SUFFIX;
            self::$TINY_VIEW[$path] = new View($fileName,$data);
        }
        return self::$TINY_VIEW[$path];
    }

    static function ControllerFactory($controller, $args) {
        if (!isset(self::$TINY_CONTROLLER[$controller])) {
            $className = ucfirst($controller) . '_Controller';
//            $fileName = $controller.'_controller'.TINY_PHP_SUFFIX;
            if (!class_exists($className)) {
                self::import(TINY_CONTROLLER_DIRNAME.'.'.  strtolower($controller));
            }
            $tmp_ref = new ReflectionClass($className);
            self::$TINY_CONTROLLER[$controller] = $tmp_ref->newInstanceArgs($args);
        }
        return self::$TINY_CONTROLLER[$controller];
    }

    static function routerFactory(Array $router_info) {
        if (isset(self::$TINY_ROUTER[$router_info['controller']])) {
            if (isset(self::$TINY_ROUTER[$router_info['controller']][$router_info['action']])) {
                return self::$TINY_ROUTER[$router_info['controller']][$router_info['action']];
            } else {
                self::$TINY_ROUTER[$router_info['controller']] = array();
            }
        } else {
            self::$TINY_ROUTER[$router_info['controller']] = array();
            self::$TINY_ROUTER[$router_info['controller']][$router_info['action']] = array();
        }
        self::$TINY_ROUTER[$router_info['controller']][$router_info['action']] =
                new Router($router_info['controller'], $router_info['action']);
        return self::$TINY_ROUTER[$router_info['controller']][$router_info['action']];
    }

    static function dispatch(Router $router, Request $request) {
        self::$TINY_CU_RESPONSE = new Response($router->getCaller(), $request);
    }

    static function go() {
        $start_time = microtime(true);
        self::init();
        self::dispatch(self::$TINY_CU_ROUTER, self::$TINY_CU_REQUEST);
        $output = &self::$TINY_CU_RESPONSE->output();
        print($output);
        $end_time = microtime(true);
        if(defined('TINY_DEBUG')){
            $time_cost = $end_time - $start_time;
            echo "The Page cost:{$time_cost} s.";
        }
    }

    static function import($path) {
        //import x.y x/y.php
        //import x.y.* x/y/*.php
        $path = trim($path);
        if (empty($path)) {
            throw new Tiny_Exception();
        }
        $len = strlen($path);
        $full_dir = false;
        if ($path[$len - 1] == '*') {
            $full_dir = true;
        }
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
//        foreach (self::$TINY_IMPORT_PATH as $import_path) {
//            $path = $import_path . $path;
        if ($full_dir) {
            if (!is_dir($path)) {
                throw new Tiny_Exception();
            }
            $dir_handler = opendir(substr($path, 0, -1));
            if (!$dir) {
                throw new Tiny_Exception();
            }
            while ($item = readdir($dir_handler)) {
                if (isset(self::$TINY_IMPORTED[$item])) {
                    continue;
                }
                $offset = strrpos($item, '.');
                if ($offset === false) {
                    continue;
                }
                if (substr($item, $offset) != TINY_PHP_SUFFIX) {
                    continue;
                }
                require($item);
                self::$TINY_IMPORTED[$item] = true;
            }
        } else {
            $filename = strtolower($path) . TINY_PHP_SUFFIX;
            if (!isset(self::$TINY_IMPORTED[$filename])) {
                require($filename);
                self::$TINY_IMPORTED[$filename] = true;
            }
        }
//        }
        return true;
    }

    static function setIncludePath() {
        set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, self::$TINY_IMPORT_PATH));
    }

    static function addImportPath($path) {
        self::$TINY_IMPORT_PATH [] = $path;
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    }
    
    static function config($key,$value = null){
        if($value === null){
            return self::$TINY_CONFIG[$key];
        }else{
            return self::$TINY_CONFIG[$key] = $value;
        }
    }

}

?>