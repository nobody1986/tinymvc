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
    static $TINY_IMPORT_PATH = array(TINY_APP_DIR, TINY_ROOT,);
    static $TINY_CONFIG = array();

    static function init($requestHandler = null, $responseHandler = null) {
        self::setIncludePath();
        $request = self::requestFactory($requestHandler);
        $request->parseHeader();
        $info_parsed = array();
        $info_parsed['controller'] = $request->getController();
        $info_parsed['action'] = $request->getAction();
        self::$TINY_CU_ROUTER = self::routerFactory($info_parsed);
        self::$TINY_CU_REQUEST = $request;
        return self::$TINY_CU_ROUTER;
    }

    static function reactInit($requestHandler = null, $responseHandler = null) {
        self::setIncludePath();
        $request = self::requestFactory($requestHandler);
        $request->parseHeader();
        $info_parsed = array();
        $info_parsed['controller'] = $request->getController();
        $info_parsed['action'] = $request->getAction();
        //$router = self::routerFactory($info_parsed);
        return array($request, $info_parsed);
    }

    /**
     * @return Request
     */
    static function requestFactory($requestHandler) {
        //web request
        switch (TINY_RUN_MODEL) {
            case 'normal' :
                return (new Request());
                break;
            case 'react' :
                $request = new ReactRequest();
                $request->setRequestHandler($requestHandler);
                return $request;
                break;
        }
    }

    static function viewFactory($path = '', Array $data = array()) {
        if (!isset(self::$TINY_VIEW[$path])) {
            $fileName = str_replace('.', DIRECTORY_SEPARATOR, $path) . TINY_TEMPLATE_SUFFIX;
            self::$TINY_VIEW[$path] = new View($fileName, $data);
        }
        return self::$TINY_VIEW[$path];
    }

    static function ControllerFactory($controller, $args) {
        if (!isset(self::$TINY_CONTROLLER[$controller])) {
            $className = ucfirst($controller) . '_Controller';
            //            $fileName = $controller.'_controller'.TINY_PHP_SUFFIX;
            if (!class_exists($className)) {
                self::import(TINY_CONTROLLER_DIRNAME . '.' . strtolower($controller));
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
        self::$TINY_ROUTER[$router_info['controller']][$router_info['action']] = new Router($router_info['controller'], $router_info['action']);
        return self::$TINY_ROUTER[$router_info['controller']][$router_info['action']];
    }

    static function dispatch(Router $router, Request $request) {
        switch (TINY_RUN_MODEL) {
            case 'normal' :
                self::$TINY_CU_RESPONSE = new Response($router->getCaller(), $request);
                break;
            case 'react' :
                return new ReactResponse($router->getCaller(), $request);
                break;
        }
    }

    static function go() {
        $start_time = microtime(true);
        if (!defined('TINY_RUN_MODEL')) {
            define('TINY_RUN_MODEL', 'normal');
        }
        switch (TINY_RUN_MODEL) {
            case 'normal' :
                self::init();
                self::dispatch(self::$TINY_CU_ROUTER, self::$TINY_CU_REQUEST);
                $output = &self::$TINY_CU_RESPONSE->output();
                self::$TINY_CU_RESPONSE->write($output);
                break;
            case 'react' :
                require_once (TINY_CORE_DIR . 'reactrequest.php');
                require_once (TINY_CORE_DIR . 'reactresponse.php');
                $mime_types = include_once (TINY_CORE_DIR . 'mime.php');
                require TINY_CORE_DIR . 'react/vendor/autoload.php';
                var_dump($mime_types);
                $stack = new React\Espresso\Stack(function($request, $response) use ($mime_types) {
                                    try {
                                        $path = $request->getPath();
                                        if (preg_match("#^/static#i", $path)) {
                                            $file_name = basename($path);
                                            $file_dir = TINY_APP_DIR . $path;
                                            if (file_exists($file_dir)) {

                                                $ext = explode('.', $file_name);
                                                $size = sizeof($ext);
                                                echo $ext[$size - 1];
                                                echo $mime_types[$ext[$size - 1]];
                                                if (sizeof($ext) == 1 || !isset($mime_types[$ext[$size - 1]])) {
                                                    $mime = "application/octet-stream";
                                                } else {
                                                    $mime = $mime_types[$ext[$size - 1]];
                                                }
                                                $response->writeHead(200, array('Content-Type' => $mime));
                                                $response->end(file_get_contents($file_dir));
                                            } else {
                                                $response->writeHead(404, array('Content-Type' => 'text/html'));
                                                $response->close();
                                            }
                                            return;
                                        }
                                        list($req, $info) = Core::reactInit($request, $response);
                                        $respon = new ReactResponse(array($info['controller'], $info['action']), $req);
                                        $respon->setResponseHandler($response);
                                        $response->writeHead(200, array('Content-Type' => 'text/html'));
                                        $output = &$respon->output();
                                        if (!empty($output)) {
                                            $respon->write($output);
                                        }
                                        $response->end();
                                        //$response -> close();
                                    } catch (Exception $e) {
                                        echo $e->getMessage();
                                        echo "\n";
                                        $response->writeHead(404, array('Content-Type' => 'text/html'));
                                        $response->end("<h1>404</h1>");
                                    }
                                });

                echo "Server running at http://127.0.0.1:8888\n";
                $stack->listen(8888);
                break;
        }

        $end_time = microtime(true);
        if (defined('TINY_DEBUG') && TINY_DEBUG) {
            $time_cost = $end_time - $start_time;
            echo "The Page cost:{$time_cost} s.";
        }
    }

    static function import($path) {
        //import x.y x/y.php
        //import x.y.* x/y/*.php
        $path = trim($path);
        if (empty($path)) {
            throw new Tiny_Exception('empty import', 2);
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
                throw new Tiny_Exception('{$path} is not a dir', 3);
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
                require ($item);
                self::$TINY_IMPORTED[$item] = true;
            }
        } else {
            $filename = ($path) . TINY_PHP_SUFFIX;
//            $filename = strtolower($path) . TINY_PHP_SUFFIX;
            if (!isset(self::$TINY_IMPORTED[$filename])) {
                $include_path = get_include_path();
                if(strpos($include_path, ';') === false){
                    //linux
                    $include_path = explode(':', $include_path);
                }else{
                    //windows
                    $include_path = explode(';', $include_path);
                }
                $exists = false;
                foreach ($include_path as $p) {
                    if (file_exists($p . $filename)) {
                        $exists = true;
                    }
                }
                if (!$exists) {
                    throw new Tiny_Exception("{$filename} not exists\n", 1);
                }
                require ($filename);
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
        self::$TINY_IMPORT_PATH[] = $path;
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    }

    static function config($key, $value = null) {
        if ($value === null) {
            return self::$TINY_CONFIG[$key];
        } else {
            return self::$TINY_CONFIG[$key] = $value;
        }
    }

}

?>