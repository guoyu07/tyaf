<?php
/**
 * @name Index.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/8
 */
use  models\admin\adminUser;
class IndexController extends  common\admin {
        function init()
        {
            parent::init(); // TODO: Change the autogenerated stub
        }
        public function indexAction()
        {
            $data = '';
            $this->getView()->assign('data',$data)->display('index/index.html');
        }
        public function testAction()
        {
            //echo 1;
        }
        public function mainAction()
        {
            $data = '';
            $this->getView()->assign('data',$data)->display('index/main.html');
        }
        public function settingAction()
        {
            $admin = new adminUser();
            $info =  $admin->test();
            $data = $info;
            $this->getView()->assign('data',$data)->display('index/setting.html');
        }

        public function listsAction()
        {
            echo 3;
        }

        public function uploadAction()
        {
                $this->_display();
        }
 }