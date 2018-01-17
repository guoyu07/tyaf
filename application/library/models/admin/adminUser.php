<?php
/**
 * @name adminUser.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/17
 */
namespace models\admin;

use common\models;

class adminUser extends models
{
    /**
     * @表名
     * @var string
     */
    protected $_table_name = 'admin';
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        return $this->db->select($this->_table_name,"*");
    }

}