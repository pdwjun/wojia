<?php

class ServiceController extends Controller
{
    public function accessRules()
    {
        return CMap::mergeArray(
            array(
                array(
                    'allow',
                    'actions' => array('index'),
                    'roles' => array('service:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('service:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('service:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('service:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('service:active'),
                ),
            ),
            parent::accessRules()
        );
    }

    public function actions()
    {
        return array(
            'view' => array(
                'class' => 'ViewAction',
                'modelName' => 'ServiceModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'ServiceIndexForm',
                'modelName' => 'ServiceModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'ServiceCreateForm',
                'modelName' => 'ServiceModel',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'formName' => 'ServiceUpdateForm',
                'modelName' => 'ServiceModel',
            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'ServiceModel',
            ),
        );
    }
}