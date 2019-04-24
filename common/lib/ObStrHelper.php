<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/24 0024
 * Time: 下午 4:45
 */
namespace common\lib;
class ObStrHelper{
    /**
     * User: wangxiaoxiao
     * Description: 随机生成字母加数字组合
     */
    public static function randomkeys($length)
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return $key;
    }
}