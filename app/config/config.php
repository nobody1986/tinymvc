<?php
require_once('../config/config.php');

//dirname(__FILE__).DIRECTORY_SEPARATOR.'..'
define('TINY_APP_DIR',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('TINY_MODEL_DIR',TINY_APP_DIR.TINY_MODEL_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_CONTROLLER_DIR',TINY_APP_DIR.TINY_CONTROLLER_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_VIEW_DIR',TINY_APP_DIR.TINY_VIEW_DIRNAME.DIRECTORY_SEPARATOR);
define('TINY_TMP_DIR',TINY_APP_DIR.TINY_TMP_DIRNAME.DIRECTORY_SEPARATOR);

define('TINY_DEBUG',false);
define('DB_DRIVER','sqlite');

define('APP_THEME','v2ex');
define('APP_THEME_DIR',TINY_VIEW_DIR.'theme'.DIRECTORY_SEPARATOR.APP_THEME.DIRECTORY_SEPARATOR);
define('APP_THEME_URI','/static/themes/'.APP_THEME.'/');

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
    'app_theme_uri' => APP_THEME_URI,
));
