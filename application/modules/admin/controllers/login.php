<?php
/**
 * @name login.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/8
 */
use common\YUrl;
class loginController extends common\controller{
        function init()
        {
            parent::init(); // TODO: Change the autogenerated stub
            $this->getView()->setScriptPath(APP_PATH.'/templates/hadmin/admin');
        }
        public function loginAction()
        {
            $data = '';
            if($this->_request->isPost()){
                $user = $_POST['user'];
                $password = $_POST['password'];
                $ret = $this->db->get("admin", "*", [
                    "name" => $user
                ]);
                if($ret)
                {
                    if (password_verify($password, $ret['password'])) {
                        session::set('admin_user',$ret,3600);
                        $this->redirect(bUrl('admin/index/index'));
                    }
                    $data = '密码错误';
                }else
                {
                    $data = '用户名错误';
                }
            }
            $this->getView()->assign('data',$data)->display('login/login.html');
        }

        public function loginOutAction()
        {
            session::clear('admin_user');
            $this->redirect(bUrl('admin/login/login'));
        }


}