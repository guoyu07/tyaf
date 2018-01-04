<?php
namespace common;
class controller extends \Yaf\Controller_Abstract{
    protected $db;
    protected $config;
    function init()
    {
        $this->config = \Yaf\Registry::get('config');
        $this->db = \Yaf\Registry::get('db');
    }
}