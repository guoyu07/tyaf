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
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
        $this->client->connect("127.0.0.1", 9500 , 1);
//        p( $this->client);
        $array = [1,2];
        $this->client->send('SELECT * FROM `user`');//执行查询
        $res=$this->client->recv();
        p( $res );
    }

}