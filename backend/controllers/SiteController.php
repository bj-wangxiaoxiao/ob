<?php

namespace backend\controllers;

use common\models\AdminLoginForm;
use common\models\AdminUser;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }
	
	public function actionError()
	{
		$msg = Yii::$app->errorHandler->exception->getMessage();
		return $this->render('error', ['message' => $msg]);
	}
	
//	public function actionError()
//	{
//		$exception = Yii::$app->errorHandler->exception;
//		if ($exception !== null) {
//			return $this->render('error', ['message' => $exception->getMessage()]);
//		}
//	}
//
	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	
	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$model = new AdminLoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//更新用户ip
			$model->userinfoUpdate();
			return $this->goBack();
		} else {
			$model->password = '';
			
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}
	
	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();
		
		return $this->goHome();
	}
}
