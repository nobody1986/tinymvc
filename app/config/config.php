<?php
require_once('../config/config.php');

//dirname(__FILE__).DIRECTORY_SEPARATOR.'..'
define('TINY_APP_DIR',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('TINY_MODEL_DIR',TINY_APP_DIR.TINY_MODEL_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_CONTROLLER_DIR',TINY_APP_DIR.TINY_CONTROLLER_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_VIEW_DIR',TINY_APP_DIR.TINY_VIEW_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_TMP_DIR',TINY_APP_DIR.TINY_TMP_DIRNAME.DIRECTORY_SEPARATOR);

define('TINY_DEBUG',true);
define('DB_DRIVER','sqlite');
Core::config('database',array(
    'host' => 'localhost',
    'name' => 'root',
    'pass' => '111111',
    'db' => TINY_APP_DIR.'data'. DIRECTORY_SEPARATOR .'test.db',
    'encoding' => 'UTF8',
));

Core::config('site_info',array(
    'title' => '星光之地',
    'desc' => '随着时光，大家都被杀猪刀削去了点什么。',
));