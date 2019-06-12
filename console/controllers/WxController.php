<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 下午 4:57
 */

namespace console\controllers;


use frontend\models\WxUser;
use yii\console\Controller;

class WxController extends Controller
{
	public function actionCrontab(){
		$users = WxUser::find()->where(['remind'=>1])->asArray()->all();
		print_r($users);
	}
}