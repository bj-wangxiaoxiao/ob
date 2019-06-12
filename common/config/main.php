<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
	    'authManager' => [
    			'class' =>'yii\rbac\DbManager',
    	],
	    //log前后台单独配
//	    'log' => [
//		    'traceLevel' => YII_DEBUG ? 3 : 0,
//		    'targets' => [
//			    [
//				    'class' => 'yii\log\FileTarget',
//				    'levels' => ['info', 'warning','trace'],
//				    'categories'=>['runtime'],
//				    'logFile'=>'@runtime/logs/app_'.date('Ymd').'.log',
//				    'logVars' => ['_POST'],
//			    ],
//			    [
//				    'class' => 'yii\log\DbTarget',
//				    'levels' => ['error','warning'],
//			    ],
//		    ],
//	    ],
    ],
];
