<?php

/**
 * Class ManagerController
 */
class ManagerController extends Controller
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
                    'roles' => array('manager:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('manager:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('manager:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('manager:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('manager:active'),
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
                'modelName' => 'ManagerModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'ManagerIndexForm',
                'modelName' => 'ManagerModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'ManagerCreateForm',
                'modelName' => 'ManagerModel',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'formName' => 'ManagerUpdateForm',
                'modelName' => 'ManagerModel',
            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'ManagerModel',
            ),
        );
    }
}