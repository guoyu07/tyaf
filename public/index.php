<?php
/**
 * @name index.php
 * @desc
 * @author 胡扬星
 * @createtime : 2017/12/29
 */


define('APPLICATION_PATH', dirname(__FILE__).'/../');
define('APP_PATH', dirname(__FILE__).'/../');
//ini_set('display_errors',"On");

$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
