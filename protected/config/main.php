<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Wojia',
    'theme' => 'wojia',
    'language' => 'zh_cn',
    'preload' => array(
        'log',
//        'settings',
    ),
    'import' => array(
        'application.components.user.*',
        'application.components.form.*',
        'application.components.model.*',
        'application.components.action.*',
        'application.components.behavior.*',
        'application.components.controller.*',

        'application.models.option.*',
        'application.models.project.*',
        'application.models.service.*',
        'application.models.user.*',

        'application.forms.administrator.*',
        'application.forms.customer.*',
        'application.forms.manager.*',
        'application.forms.member.*',
        'application.forms.project.*',
        'application.forms.service.*',
        'application.forms.option.*',
        'application.forms.user.*',
    ),
    'components' => array(
        'session' => array(
            'cookieParams' => array(
                'httpOnly' => true,
            ),
        ),
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
            'returnUrl' => array('site/index'),
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'cssFile' => false,
                ),
            ),
        ),
        'settings' => array(
            'class' => 'application.components.option.Settings',
        ),
    ),
);