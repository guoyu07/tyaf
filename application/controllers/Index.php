<?php

/**
 * @name IndexController
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/4
 * Class IndexController
 */
class IndexController extends common\controller
{

    public function init()
    {
        parent::init();
    }

    /**
     * 默认动作
     * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/tyaf/index/index/index/name/vagrant 的时候, 你就会发现不同
     */
    public function indexAction()
    {
//        $toemail = 'vate96@163.com';
//        $title = '测试';
//        $content = '<h1>德玛西亚人万岁</h1>';
//        $send = sendmail($toemail,$title,$content);
//        dd($send);
    }

    public function testAction()
    {
//        echo session::get('code');
    }
}
