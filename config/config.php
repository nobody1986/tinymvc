<?php

define('TINY_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('TINY_DEFAULT_CONTROLLER', 'index');
define('TINY_DEFAULT_ACTION', 'index');

define('TINY_PHP_SUFFIX', '.php');
//define('TINY_TEMPLATE_SUFFIX','.php');
define('TINY_TEMPLATE_SUFFIX', '.html');
define('TINY_DEFAULT_GATEWAY', 'index');
define('TINY_CORE_DIR', TINY_ROOT . 'core' . DIRECTORY_SEPARATOR);
define('TINY_LIB_DIR', TINY_ROOT . 'lib' . DIRECTORY_SEPARATOR);
define('TINY_EXCEPTION_DIR', TINY_ROOT . 'exception' . DIRECTORY_SEPARATOR);
//define('TINY_VIEW_ENGINE','');
define('TINY_VIEW_ENGINE', 'twig');

require_once(TINY_CORE_DIR . 'core.php');
require_once(TINY_CORE_DIR . 'request.php');
require_once(TINY_CORE_DIR . 'response.php');
require_once(TINY_CORE_DIR . 'router.php');
require_once(TINY_CORE_DIR . 'controller.php');
require_once(TINY_CORE_DIR . 'model.php');
require_once((TINY_VIEW_ENGINE == '' ? TINY_CORE_DIR : TINY_LIB_DIR . TINY_VIEW_ENGINE . '_') . 'view.php');
require_once(TINY_EXCEPTION_DIR . 'tiny_exception.php');

define('TINY_APP_DIRNAME', 'app');
define('TINY_MODEL_DIRNAME', 'model');
define('TINY_CONTROLLER_DIRNAME', 'controller');
define('TINY_VIEW_DIRNAME', 'view');
define('TINY_TMP_DIRNAME', 'tmp');

define('TINY_RUN_MODEL', 'cc');

$Routers = array(
    '/hello' => array('default', 'index'),
);

