<?php
require_once('../config/config.php');

define('TINY_DEBUG',true);

Core::config('database',array(
    'host' => 'localhost',
    'name' => 'root',
    'pass' => '111111',
    'db' => 'test',
    'encoding' => 'UTF8',
));

Core::config('site_info',array(
    'title' => '星光之地',
    'desc' => '随着时光，大家都被杀猪刀削去了点什么。',
));
?>