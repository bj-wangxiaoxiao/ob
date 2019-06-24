<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/19 0019
 * Time: 上午 9:51
 */

namespace console\controllers;


use backend\models\SignupForm;
use Yii;
use yii\console\Controller;

class AdminUserController extends Controller
{
	public function actionAdd(){
		$model = new SignupForm();
		
		fwrite(STDOUT,'input your admin username : ');
		$model->name = trim(fgets(STDIN));
		fwrite(STDOUT,'input your admin phone : ');
		$model->phone = trim(fgets(STDIN));
		fwrite(STDOUT,'input your admin nickname : ');
		$model->nickname = trim(fgets(STDIN));
		fwrite(STDOUT,'input your admin password : ');
		$model->password = trim(fgets(STDIN));
		fwrite(STDOUT,'input your admin email : ');
		$model->email = trim(fgets(STDIN));
		$admin_user = $model->signup();
		if(!$admin_user){
			print_r($model->getErrors());die;
		}
		print_r("congratulation ! add admin user success ! admin_user_id = {$admin_user->admin_user_id}\n");
	}
}