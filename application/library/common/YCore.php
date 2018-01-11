<?php
/**
 * @name YCore.php
 * @desc  公共类库
 * @author 胡扬星
 * @createtime : 2017/12/29
 */
namespace common;
class YCore{


    /**
     * @name getSessionRedisCache
     * @desc  获取系统缓存对象。
     * @author 胡扬星
     * @createtime : 2017/12/29
     * @return mixed|\Redis
     */
    public static function getSessionRedisCache() {
        $ok = \Yaf\Registry::has('session_redis');
        if ($ok) {
            return \Yaf\Registry::get('session_redis');
        } else {
            $config = \Yaf\Registry::get('config');
            $redis_host = $config->redis->session->host;
            $redis_port = $config->redis->session->port;
            $redis_pwd = $config->redis->session->pwd;
            $redis_index = $config->redis->session->index;
            $redis = new \Redis();
            $redis->connect($redis_host, $redis_port);
            $redis->auth($redis_pwd);
            $redis->select($redis_index);
            \Yaf\Registry::set('session_redis', $redis);
            return $redis;
        }
    }

    public function error_handler()
    {
        $whoops = new \Whoops\Run;
        dd($whoops);
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}