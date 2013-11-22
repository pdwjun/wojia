<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'modules' => array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'development',
                'ipFilters' => array(
                    '127.0.0.1',
                    '::1',
                ),
            ),
        ),
        'components' => array(
            'cache' => array(
                'class' => 'CApcCache',
            ),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=wojia.local',
                'emulatePrepare' => true,
                'username' => 'jason',
                'password' => 'lrc207107',
                'charset' => 'utf8',
                'enableProfiling' => true,
                'enableParamLogging' => true,
            ),
            'log' => array(
                'routes' => array(
                    array(
                        'class' => 'CProfileLogRoute',
                        'levels' => 'profile',
                        'enabled' => true,
                    ),
                ),
            ),
        ),
    )
);