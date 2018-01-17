<?php
/**
 * @name models.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/17
 */
namespace common;
class models {
    protected $db;
    protected $config;
    function __construct()
    {
        $this->config = \Yaf\Registry::get('config');
        $this->db = \Yaf\Registry::get('db');
    }
}