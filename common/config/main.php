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
	    'log' => [
		    'traceLevel' => YII_DEBUG ? 3 : 0,
		    'targets' => [
			    [
				    'class' => 'yii\log\FileTarget',
				    'levels' => ['info', 'warning','trace'],
				    'logFile'=>'@runtime/logs/app_'.date('Ymd').'.log',
			    ],
			    [
				    'class' => 'yii\log\DbTarget',
				    'levels' => ['error','warning'],
			    ],
		    ],
	    ],
    ],
];
