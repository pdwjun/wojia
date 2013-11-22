<?php

/**
 * Class AdministratorController
 */
class AdministratorController extends Controller
{
    /**
     * Access rules
     *
     * @return array
     */
    public function accessRules()
    {
        return CMap::mergeArray(
            array(
                array(
                    'allow',
                    'actions' => array('index'),
                    'roles' => array('administrator:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('administrator:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('administrator:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('administrator:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('administrator:active'),
                ),
            ),
            parent::accessRules()
        );
    }

    /**
     * Actions
     *
     * @return array
     */
    public function actions()
    {
        return array(
            'view' => array(
                'class' => 'ViewAction',
                'modelName' => 'AdministratorModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'AdministratorIndexForm',
                'modelName' => 'AdministratorModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'AdministratorCreateForm',
                'modelName' => 'AdministratorModel',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'formName' => 'AdministratorUpdateForm',
                'modelName' => 'AdministratorModel',
            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'AdministratorModel',
            ),
        );
    }
}