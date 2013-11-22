<?php

// get environment and run application
if (false !== strpos('jason.sbc-usst.edu.cn', $_SERVER['SERVER_NAME'])) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

    require_once('vendor/yiisoft/yii/framework/yii.php');
    Yii::createWebApplication('protected/config/development.php')->run();
} else {
    require_once('vendor/yiisoft/yii/framework/yiilite.php');
    Yii::createWebApplication('protected/config/production.php')->run();
}