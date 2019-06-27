<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 上午 10:54
 */

namespace common\lib;


use Yii;
use yii\helpers\Json;
use yii\log\Logger;

class ObLogger
{
	public static function info($message,$desc = '',$cate='runtime'){
		$message = is_array($message) ? Json::encode($message) : $message;
		$message = $desc ? $desc.'：'.$message : $message;
		Yii::info($message,$cate);
	}
}