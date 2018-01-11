<?php
/**
 * @name cookie.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/4
 */

class cookie{

    /**
     * 设置一个cookie
     *
     * @param 	string 		$cookieName 	cookie名称
     * @param 	string 		$cookieValue 	cookie值
     * @param 	number 		$time 			cookie存活时间
     * @param 	boolen 		$httponly 		是否只能通过http协议读取，如果true，客户端js无法获取cookie值
     * @param 	string 		$path 			cookie路径
     * @param 	unknown		$domain 		默认空，不用管
     * @param 	boolen 		$secure 		是否只能通过https协议访问
     *
     * @return 	boolean 	true|false
     *
     * @Author 胡木木  2018/1/4
     */
    function set($cookieName, $cookieValue = '' , $time = '', $httponly = FALSE, $path = '', $domain = '', $secure = FALSE)
    {

        if($time == '' || !is_numeric($time))
        {
            $time = time()+1800;
        }
        else
        {
            $time = time()+$time;
        }
        if($cookieName != '')
        {
            setcookie($cookieName,$cookieValue,$time,$httponly,$path,$domain,$secure);
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

    /**
     * 获得cookie，如果没有则返回空
     *
     * @param string $cookieName 需要获取cookie的名字
     *
     * @return cookie value
     *
     * @Author 胡木木  2018/1/4
     */
    function get($cookieName)
    {
        if($cookieName != '')
        {
            return empty($_COOKIE[$cookieName])? '' : $_COOKIE[$cookieName];
        }
        else
        {
            return '';
        }
    }

    /**
     * 注释掉一个cookie
     *
     * @param string $cookieName 需要注释掉cookie的名字
     *
     * @return boolean true|false
     *
     * @Author 胡木木  2018/1/4
     */
    function drop($cookieName)
    {
        if($cookieName != '')
        {
            $this->set($cookieName, '',0);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
     * 清除所有cookies
     *
     * @param arr $cookieName 需要保留下cookie的名字 array('id','name')
     *
     * @Author 胡木木  2018/1/4
     */
    public function dropall()
    {
        if(isset($_COOKIE))
        {
            unset($_COOKIE);
        }

    }
}