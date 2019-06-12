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
    
    public static function Xml2Array($file_content){
	    return json_decode(json_encode(simplexml_load_string($file_content, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
	
	public static function handleErrors2Str($errors){
		if(empty($errors)){
			return '';
		}
		
		if(is_string($errors)){
			return $errors;
		}
		$msg = '';
		if(is_array($errors)){
			foreach ($errors as $error) {
				$msg .= '【'. implode(' | ',$error).'】';
			}
		}
		
		return $msg;
	}
	
}