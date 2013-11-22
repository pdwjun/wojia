<?php

/**
 * Class CustomerController
 */
class CustomerController extends Controller
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
                    'roles' => array('customer:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('customer:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('customer:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('customer:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('customer:active'),
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
                'modelName' => 'CustomerModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'CustomerIndexForm',
                'modelName' => 'CustomerModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'CustomerCreateForm',
                'modelName' => 'CustomerModel',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'formName' => 'CustomerUpdateForm',
                'modelName' => 'CustomerModel',
            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'CustomerModel',
            ),
        );
    }
}