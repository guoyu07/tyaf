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
        Yaf\Dispatcher::getInstance()->catchException(TRUE);
    }

    public function _initPlugin(Yaf\Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(Yaf\Dispatcher $dispatcher)
    {
        $router = Yaf\Dispatcher::getInstance()->getRouter();
        $route = array();
        // 默认进入index/index
        $modules = Yaf\Application::app()->getModules();
        if($modules) {
            foreach ($modules as $module) {
                $name = strtolower($module);
                $route[$name] = new Yaf\Route\Rewrite(
                    '/('.$name.'|'.$name.'/|'.$name.'/index|'.$name.'/index/)$',
                    array(
                        'controller' => 'index',
                        'action' => 'index',
                        'module' => $name,
                    )
                );
            }
        }
        $route['admin/login'] = new Yaf\Route\Rewrite('admin/login', array('controller' => 'login', 'action' => 'login', 'module' => 'admin'));
        //使用路由器装载路由协议
        foreach ($route as $k => $v) {
            $router->addRoute($k, $v);
        }
        //自定义路由
        Yaf\Registry::set('routes', $route);
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->autoRender(false);//关闭自动渲染视图
        //在这里注册自己的view控制器，例如smarty,firekylin
    }

    public function _initFunction(Yaf\Dispatcher $dispatcher)
    {
        yaf\loader::import('function.php');
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
        // 数据库连接池方案 尚未解决
        //new db();
        //die;
        $db = new \models\Medoo([
            'database_type' => 'mysql',
            'database_name' => $this->_config->db->database,
            'server' => $this->_config->db->hostname,
            'username' => $this->_config->db->username,
            'password' => $this->_config->db->password,
            'charset' => 'utf8',
            'port' => 3306,
            'prefix' => '',
            // PDO驱动选项 http://www.php.net/manual/en/pdo.setattribute.php
            'option' => [
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]
        ]);
        \Yaf\Registry::set('db', $db);
    }


}
