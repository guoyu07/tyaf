<?php

/**
 * @name Bootstrap
 * @author vagrant
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
use  \common\YCore as YCore;
class Bootstrap extends Yaf\Bootstrap_Abstract
{
    private $_config;
    public function _initConfig()
    {
        //把配置保存起来
        $this->_config = Yaf\Application::app()->getConfig();
        Yaf\Registry::set('config', $this->_config);
        date_default_timezone_set($this->_config->get('timezone'));
    }

    /**
     * 错误相关操作初始化。
     * -- 1、开/关PHP错误。
     * -- 2、接管PHP错误。
     */
    public function _initError() {
        $error_switch = $this->_config->error_switch;
        ini_set('display_errors', $error_switch);
    }

    public function _initPlugin(Yaf\Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin
    }

    public function _initFunction(Yaf\Dispatcher $dispatcher)
    {
        yaf\loader::import('Function.php');
    }


    public function _initSession(Yaf\Dispatcher $dispatcher)
    {
        if(!preg_match("/cli/i", php_sapi_name()))
        {
            $type = ucfirst($this->_config->session->type);
            $handler = "getSession{$type}Cache";
            $cache = YCore::$handler();
            $prefix = $this->_config->session->prefix . ip2long($_SERVER['SERVER_ADDR']) . '_';
            $sess = new \session\RedisHandler($cache,  $this->_config->session->expire , $prefix);
            session_set_save_handler($sess);
            $session = Yaf\Session::getInstance();
            \Yaf\Registry::set('session', $session);
        }
    }

    public function _initDB()
    {
        $db = new db();
        dd($db);
    }

}
