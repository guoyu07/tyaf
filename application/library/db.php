<?php
/**
 * @name db.php
 * @desc
 * @author 胡扬星
 * @createtime : 2017/12/29
 */

class db
{
    private $client;

    public function __construct() {
//        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
//        $this->client->connect("127.0.0.1", 9500 , 1);
//        $this->client->send('SELECT * FROM `test`');//执行查询
//        dd( $this->client);
        $link=new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);//TCP方式、同步
        $link->connect('127.0.0.1',9500);//连接
        $i = rand(0,10);
        $link->send('SELECT * FROM `user` WHERE `id` = '.$i);//执行查询
        $res=$link->recv();

        if(!$res){
            echo 'Failed!';
        }
        else{
            print_r($res);
        }
    }

}