<?php
/**
 * @name Function.php
 * @desc
 * @author 胡扬星
 * @createtime : 2017/12/29
 */


if (!function_exists('dd')){
    /**
     * @name dd
     * @desc
     * @author 胡扬星
     * @createtime : 2017/12/29
     * @param $var
     */
    function dd($var)
    {
        if (is_bool($var)) {
            var_dump($var);
        } else if (is_null($var)) {
            var_dump(NULL);
        } else {
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
        }
        die;
    }
}

if (!function_exists('p')){
    /**
     * @name p
     * @desc
     * @author 胡扬星
     * @createtime : 2017/12/29
     * @param $var
     */
    function p($var)
    {
        if (is_bool($var)) {
            var_dump($var);
        } else if (is_null($var)) {
            var_dump(NULL);
        } else {
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
        }
    }
}

function echojson($arr)
{
    echo json_encode($arr);
}

//分页方法
function page($url,$page,$count,$offset = 20,$status='')
{
    $allpage = ceil($count/$offset);        //总页数

    if($status)
    {
        $status ='&'.$status;
    }

    $first = "<a href='".$url.'?page=1'.$status."'>首页</a>";
    $last = "<a href='".$url.'?page='.$allpage.$status."'>末页</a>";
    if($page > 1)
    {
        $shangyiye = "&nbsp;<a href='".$url.'?page='.($page-1).$status."'>上一页</a>&nbsp;";
    }
    else
    {
        $shangyiye = '&nbsp;&nbsp;';
    }
    if($page < $allpage)
    {
        $xiayiye = "&nbsp;<a href='".$url.'?page='.($page+1).$status."'>下一页</a>&nbsp;";
    }
    else
    {
        $xiayiye = '&nbsp;&nbsp;';
    }
    $page = "当前 第<span style='color:gray'>{$page}</span>&nbsp;页";

    $all = "共 ".$count." 篇&nbsp;&nbsp;共 ".$allpage." 页&nbsp;&nbsp;&nbsp;&nbsp";
    $html = $all.$first.$shangyiye.$page.$xiayiye.$last;
    return $html;
}

/**
 * 获取当前登陆状态
 * @return bool
 */
function loginstatus()
{
    $session = Yaf_Session::getInstance();
    if($session->admin)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function txtlog($name,$str)
{
    $handle = fopen("log.txt","a+");
    fwrite($handle,$name."\n");
    fwrite($handle,$str."\n\n");
    fclose($handle);
}
//生成缓存key
function cachekey($functionname,$parm = '')
{
    if($parm)
    {
        if(is_array($parm))
        {
            $tail = '';
            foreach($parm as $value)
            {
                $tail .= "_".$value;
            }
            $key = $functionname.$tail;
        }
        else
        {
            $key = $functionname.'_'.$parm;
        }
    }
    else
    {
        $key = $functionname;
    }
    return $key;
}

//生成小图片的url    /upload/20150506/aaa.jpg=>/upload/20150506/small_aaa.jpg
//如果中图不存在，则返回原图
function resizeimgurl($url,$ext = 'small')
{
    $info = pathinfo($url);
    $name = "/".$ext."_".$info['basename'];
    if($ext == 'middle')
    {

        $dir = str_replace(BASE_URL,"./",$info['dirname'].$name);
        if(!file_exists($dir))
        {
            return $url;
        }
    }
    return $info['dirname'].$name;
}

//字符串截取
function cutstr($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa ="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string); if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = ''; for($i=0; $i<$strlen; $i++)
    {
        if($i>=$start && $i<($start+$sublen))
        {
            if(ord(substr($string, $i, 1))>129)
            {
                $tmpstr.= substr($string, $i, 2);
            }
            else
            {
                $tmpstr.= substr($string, $i, 1);
            }
        }
        if(ord(substr($string, $i, 1))>129) $i++;
    }
        if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}


/**
 * @name Url
 * @desc  生成连接地址
 * @author 胡扬星
 * @createtime : 2018/1/8
 * @param $params
 * @return string
 */
 function fUrl($params)
{
    $url = 'http://';
    if (isset($_SERVER ['HTTPS']) && $_SERVER ['HTTPS'] == 'on') {
        $url = 'https://';
    }
    $url .= $_SERVER['SERVER_NAME'].'/'.$params;
    echo $url;
}

/**
 * 获取域名
 *
 * @param string $type css、js、image
 * @param string $file_relative_path 资源相对路径。如：/jquery/plugins/cookie.js
 * @return string
 */
 function local_url()
{
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
}

/**
 * 获取静态资源URL。
 *
 * @param string $type css、js、image
 * @param string $file_relative_path 资源相对路径。如：/jquery/plugins/cookie.js
 * @return string
 */
function assets($file_relative_path) {
    $temp = \Yaf\Registry::get('templates');
    if(!$temp)
    {
        $temp = 'hadmin';
    }
    $statics_url =  \Yaf\Registry::get('statics_domain_name');
    if(!$statics_url)
    {
        $statics_url = local_url();
    }
    $statics_url = trim($statics_url, '/');
    $file_relative_path = trim($file_relative_path, '/');
    return $statics_url.'/' . "$temp/".$file_relative_path;
}
/**
 * @name Url
 * @desc  生成连接地址
 * @author 胡扬星
 * @createtime : 2018/1/8
 * @param $params
 * @return string
 */
function bUrl($params)
{
    $url = 'http://';
    if (isset($_SERVER ['HTTPS']) && $_SERVER ['HTTPS'] == 'on') {
        $url = 'https://';
    }
    $url .= $_SERVER['SERVER_NAME'].'/'.$params;
    return $url;
}
/**
 * 发送邮件方法
 * @param $config  邮箱配置
 * @param $toemail
 * @param $title
 * @param $content
 * @return bool
 * @throws Exception
 * @throws phpmailerException
 */
function sendmail( $toemail, $title, $content)
{

    //******************** 配置信息 ********************************
    $mail = new PHPMailer();
    // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;
    // 使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    // smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    // 链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';
    // 设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    // 设置ssl连接smtp服务器的远程服务器端口号
    $mail->Port = 465;
    // 设置发送的邮件的编码
    $mail->CharSet = 'UTF-8';
    // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '我不告诉你哈哈哈哈哈哈';
    // smtp登录的账号 QQ邮箱即可
    $mail->Username = 'vate96@foxmail.com';
    // smtp登录的密码 使用生成的授权码
    $mail->Password = 'trbmaeojihqidiea';
    // 设置发件人邮箱地址 同登录账号
    $mail->From = 'vate96@foxmail.com';
    // 邮件正文是否为html编码 注意此处是一个方法
    $mail->isHTML(true);
    // 设置收件人邮箱地址
    $mail->addAddress($toemail);
    // 添加多个收件人 则多次调用方法即可
    // 添加该邮件的主题
    $mail->Subject = $title;
    // 添加邮件正文
    $mail->Body = $content;
    // 为该邮件添加附件
//        $mail->addAttachment('./example.pdf');
    // 发送邮件 返回状态
    return $mail->send();
}




