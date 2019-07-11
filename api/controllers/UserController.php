<?php
namespace api\controllers;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
	public $modelClass = 'common\models\User';
	
	public function actionIndex(){
		return ['error'=>1];
	}
}
