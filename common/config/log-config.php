<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/13 0013
 * Time: 下午 2:24
 */
return [
	'traceLevel' => YII_DEBUG ? 3 : 0,
	'targets' => [
		[
			'class' => 'yii\log\FileTarget',
			'levels' => ['info'],
			'categories'=>[
				'runtime',//只打印自己标记的日志ObLogger::info()
			],
			'logFile'=>'@runtime/logs/app_'.date('Ymd').'.log',
			'logVars' => ['_POST'],
			'prefix' => function ($message){   //日志格式自定义 回调方法
				$request = Yii::$app->getRequest();
				$uri = $request->getPathInfo();
				$ip = $request instanceof \yii\web\Request ? $request->getUserIP() : '-';
				return "[$ip][$uri]";
			},
		],
		[
			'class' => 'yii\log\DbTarget',
			'levels' => ['error','warning'],
		],
	],
];