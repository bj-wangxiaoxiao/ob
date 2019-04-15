<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);//标识应用是否开启调试模式
defined('YII_ENV') or define('YII_ENV', 'dev');//标识应用运行的环境,默认生产(prod)
//YII_ENABLE_ERROR_HANDLER 标识是否启用Yii提供的错误处理机制,默认true

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
