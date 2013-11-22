<?php

/**
 * Class MemberController
 */
class MemberController extends Controller
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
                    'roles' => array('member:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('member:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('member:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('member:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('member:active'),
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
                'modelName' => 'MemberModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'MemberIndexForm',
                'modelName' => 'MemberModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'MemberCreateForm',
                'modelName' => 'MemberModel',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'formName' => 'MemberUpdateForm',
                'modelName' => 'MemberModel',
            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'MemberModel',
            ),
        );
    }
}