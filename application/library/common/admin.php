<?php
/**
 * @name admin.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/8
 */
namespace common;

use session;
class admin extends \common\controller{
    protected  $templates;
    function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        //session判断
        if(!session::get('admin_user'))
        {
            $this->redirect(YUrl::createBackendUrl('admin', 'login', 'login'));
        }
        $this->getView()->setScriptPath(VIEWS_PATH."/templates/hadmin/admin");
    }
}