<?php
/**
 * @name mysql.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/4
 */
$serv = new swoole_server("127.0.0.1", 9500);
$serv->set(array(
    'worker_num' => 20,
    'task_worker_num' => 100, //database connection pool
    'db_uri' => 'mysql:host=127.0.0.1;dbname=test',
    'db_user' => 'root',
    'db_passwd' => 'hyxqq383877',
//    'task_worker_max'=>100
));
include_once dirname(__FILE__) . "/Sworm.php";
include_once dirname(__FILE__) . "/Medoo.php";
function my_onReceive($serv, $fd, $from_id, $data)
{
    $result = $serv->taskwait('111111111111');
    if ($result !== false) {
        list($status, $db_res) = explode(':', $result, 2);
        if ($status == 'OK') {

            $serv->send($fd, var_export(json_decode($db_res,true), true) . "\n");
        } else {
            $serv->send($fd, $db_res);
        }
        $serv->send($fd, "\n");
        return;
    } else {
        $serv->send($fd, "Error. Task timeout\n");
    }
}

function my_onTask($serv, $task_id, $from_id, $sql)
{
    static $link = null;
    if ($link == null) {
        $link = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => 'hyxqq383877',
            'charset' => 'utf8',
            'port' => 3306,
            'prefix' => '',
            // PDO驱动选项 http://www.php.net/manual/en/pdo.setattribute.php
            'option' => [
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]
        ]);
    }

    $sql = "insert('user', array('name'=> 't3', 'age'=>22))";
    $res = $link->{$sql};
    var_dump($res);
    $serv->finish("OK:" . json_encode($res));
}

function my_onFinish($serv, $data)
{
    echo "AsyncTask Finish:Connect.PID=" . posix_getpid() . PHP_EOL;
}

$serv->on('Receive', 'my_onReceive');
$serv->on('Task', 'my_onTask');
$serv->on('Finish', 'my_onFinish');
$serv->start();