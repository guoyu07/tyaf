<?php
/**
 * @name index.php
 * @desc
 * @author 胡扬星
 * @createtime : 2017/12/29
 */


define('APPLICATION_PATH', dirname(__FILE__).'/../');
define('APP_PATH', dirname(__FILE__).'/../');
define('APP_NAME', 'application');
define('VIEWS_PATH', APPLICATION_PATH.APP_NAME.'/views/');


$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
