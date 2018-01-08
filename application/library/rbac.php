<?php
/**
 * @name rbac.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/8
 */

class rbac
{
    /**
     * 类的唯一实例
     */
    private static $instance;

    /**
     * 权限常量
     */
    const SELECT = 0x1; //查询
    const CREATE = 0x2; //添加
    const EDIT    = 0x4; //修改
    const DELETE = 0x8; //删除

    /**
     * 角色
     */
    private $annoy = ''; //匿名用户
    private $user   = ''; //注册用户
    private $admin = ''; //管理用户
    private $usertype = 'annoy';
    private $hashtable = array(1=>'查询',2=>'添加',4=>'修改',8=>'删除');

    /**
     *
     */
    public function __set($name,$value)
    {
        if ($name == 'usertype')
        {
            if ($value != '')
            {
                $this->usertype = $value;
            }
        }
    }

    /**
     * 构造函数 给角色赋予权限
     */
    private function __construct()
    {
        $this->annoy = self::SELECT;
        $this->user = self::SELECT | self::CREATE;
        $this->admin = self::SELECT | self::CREATE | self::EDIT | self::DELETE;
    }

    /**
     * 获取类的唯一实例
     */
    public static function getInstance()
    {
        if (self::$instance === null){
            self::$instance = new rbac();
        }
        return self::$instance;
    }

    /**
     * 检查权限
     *
     * @param $usertype 角色
     * @param $purview 权限
     */
    public function check($purview)
    {
        if ($this->{$this->usertype} & $purview)
        {
            return true;
        }
        return false;
    }

    /**
     * 给角色加权限
     */
    public function addPur($purview)
    {
        $this->{$this->usertype} |= $purview;
    }

    /**
     * 给角色减权限
     */
    public function delPur($purview)
    {
        $this->{$this->usertype} ^= $purview;
    }

    /**
     * 返回角色拥有的权限
     */
    public function getPur()
    {
        $arr = array();
        foreach ($this->hashtable as $k => $v)
        {
            if ($k & $this->{$this->usertype})
            {
                $arr[] = $v;
            }
        }
        return $arr;
    }
}