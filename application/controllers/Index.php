<?php

/**
 * @name IndexController
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/4
 * Class IndexController
 */
class IndexController extends common\controller {

    public function init()
    {
        parent::init();
    }

    /**
     * 默认动作
     * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/tyaf/index/index/index/name/vagrant 的时候, 你就会发现不同
     */
	public function indexAction() {

        //User name off the mail box
        $username = 'vate96@163.com';
        //Password of mailbox
        $password = 'hyxqq383877';
        //Email address of that mailbox some time the uname and email address are identical
        $email_address = '***';
        //Ip or name of the POP or IMAP mail server
        $mail_server = 'imap.163.com';
        //if this server is imap or pop default is pop
        $server_type = 'imap';
        //Server port for pop or imap Default is 110 for pop and 143 for imap
        $port = 143;

        $mail = new email($username,$password,$email_address,$mail_server,$server_type,$port);
        $mail->connect();

        $mail_total = $mail->get_mail_total();

        for ($i=$mail_total; $i>0; $i--) {
            //附件读取这块，我没搞懂，如果哪位能修好，记得通知我。
            $str = $mail->get_attach($i,"./");
            $arr = explode(",",$str);
            foreach($arr as $key=>$value) echo ($value == "") ? "" : "Atteched File :: " . $value . "<br>";
            echo "<br>------------------------------------------------------------------------------------------<br>";
            exit;
        }
//	    $code = captcha::create();
        return true;
	}

	public function testAction()
    {
        echo session::get('code');
        return false;
    }
}
