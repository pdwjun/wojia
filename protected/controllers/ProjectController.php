<?php

/**
 * Class ProjectController
 */
class ProjectController extends Controller
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
                    'roles' => array('project:index'),
                ),
                array(
                    'allow',
                    'actions' => array('view'),
                    'roles' => array('project:view'),
                ),
                array(
                    'allow',
                    'actions' => array('create'),
                    'roles' => array('project:create'),
                ),
                array(
                    'allow',
                    'actions' => array('update'),
                    'roles' => array('project:update'),
                ),
                array(
                    'allow',
                    'actions' => array('active'),
                    'roles' => array('project:active'),
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
                'modelName' => 'ProjectModel',
            ),
            'index' => array(
                'class' => 'IndexAction',
                'formName' => 'ProjectIndexForm',
                'modelName' => 'ProjectModel',
            ),
            'create' => array(
                'class' => 'CreateAction',
                'formName' => 'ProjectCreateForm',
                'modelName' => 'ProjectModel',
            ),
//            'update' => array(
//                'class' => 'UpdateAction',
//                'formName' => 'ProjectUpdateForm',
//                'modelName' => 'ProjectModel',
//            ),
            'active' => array(
                'class' => 'ActiveAction',
                'modelName' => 'ProjectModel',
            ),
        );
    }

    public function actionUpdate($id)
    {
        // set form model
        $form = new ProjectUpdateForm;

        // set database model
        $model = ProjectModel::model()->findByPk($id);
        if (null === $model)
            throw new CHttpException(404, Yii::t('wojia', 'The requested page does not exist.'));

        // set & populate model
        $form->setModel($model);
        $form->populate();

        if ($form->status == ProjectModel::STATUS_COMPLETE && Yii::app()->user->isCustomer)
            $form->scenario = 'complete';

        // get form attributes
        if ($attributes = Yii::app()->request->getPost('ProjectUpdateForm')) {
            // set form attributes
            $form->setAttributes($attributes);

            if ($form->save()) {
                // set updated flash
                Yii::app()->user->setFlash('update', true);

                // redirect
                $this->redirect(array(
                    'update',
                    'id' => $form->id,
                ));
            }
        }

        // render
        $this->render('update', array(
            'form' => $form,
        ));
    }
}