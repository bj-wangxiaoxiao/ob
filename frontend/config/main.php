<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),//默认前台根目录
    'bootstrap' => ['log'],
    'language'  =>  'zh-CN',
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute'  =>  'site/index',//设置前台默认路由
    'components' => [
	    'wechat' => [
		    'class' => 'callmez\wechat\sdk\MpWechat',
		    'appId' => 'wxe383268e2e7f057c',
		    'appSecret' => '10a3c355837561105f2779a59579f11a',
		    'encodingAesKey' => 'PPTZG11oYygrOtGG2IZjrnJQj5byIROYv422fFUQb8q',
		    'token' => 'obtoken'
	    ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
	            [
		            'class' => 'yii\log\FileTarget',
		            'levels' => ['info'],
		            'categories'=>['runtime'],
		            'logFile'=>'@runtime/logs/frontend_'.date('Ymd').'.log',
		            'logVars' => ['_POST'],
	            ],
	            [
		            'class' => 'yii\log\DbTarget',
		            'levels' => ['error','warning'],
	            ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //开启url美化
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
	'modules' => [
		'test' => [
			'class' => 'app\modules\test\Test',
		],
	],
];
