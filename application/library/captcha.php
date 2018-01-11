<?php

/**
 * @name captcha.php
 * @desc
 * @author 胡扬星
 * @createtime : 2018/1/4
 */
class captcha
{
    function create()
    {
        header("Content-type:image/png");
        $captcha5 = new \captcha\captcha();

        //@设置验证码宽度
        $captcha5->setWidth(200);

        //@设置验证码高度
        $captcha5->setHeight(50);

        //@设置字符个数
        $captcha5->setTextNumber(4);

        //@设置字符颜色
        $captcha5->setFontColor('#ff9900');

        //@设置字号大小
        $captcha5->setFontSize(25);

        //@设置字体
        $captcha5->setFontFamily(APPLICATION_PATH.'./font/test.ttf');

        //@设置语言
        $captcha5->setTextLang('cn');

        //@设置背景颜色
        $captcha5->setBgColor('#000000');

        //@设置干扰点数量
        $captcha5->setNoisePoint(600);

        //@设置干扰线数量
        $captcha5->setNoiseLine(10);

        //@设置是否扭曲
        $captcha5->setDistortion(true);

        //@设置是否显示边框
        $captcha5->setShowBorder(true);

        //输出验证码

        $code = $captcha5->createImage();
        session::set('code',$code);
    }

}
