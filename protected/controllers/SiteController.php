<?php

/**
 * Class SiteController
 */
class SiteController extends Controller
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
                    'roles' => array('site:index'),
                ),
                array(
                    'allow',
                    'actions' => array('login'),
                    'roles' => array('site:login'),
                ),
                array(
                    'allow',
                    'actions' => array('logout'),
                    'roles' => array('site:logout'),
                ),
                array(
                    'allow',
                    'actions' => array('profile'),
                    'roles' => array('site:profile'),
                ),
                array(
                    'allow',
                    'actions' => array('error'),
                    'roles' => array('site:error'),
                ),
            ),
            parent::accessRules()
        );
    }

    /**
     * Error
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo CJSON::encode(array(
                    'error' => true,
                    'message' => $error['message'],
                ));

                Yii::app()->end();
            } else
                $this->render('error', $error);
        }
    }

    /**
     * Login
     */
    public function actionLogin()
    {
        $form = new UserLoginForm;

        if ($attributes = Yii::app()->request->getPost('UserLoginForm')) {
            $form->setAttributes($attributes);

            if ($form->validate() && $form->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login', array(
            'form' => $form,
        ));
    }

    /**
     * Logout
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();

        $this->redirect(array('login'));
    }

    /**
     * Profile
     */
    public function actionProfile()
    {
        $user = Yii::app()->user;

        $form = new UserProfileForm;
        $form->setModel($user->model);
        $form->populate();

        if ($attributes = Yii::app()->request->getPost('UserProfileForm')) {
            $form->setAttributes($attributes);

            if ($form->save()) {
                $user->setFlash('update', true);

                $this->refresh();
            }
        }

        $this->render('profile', array(
            'form' => $form,
        ));
    }

    /**
     * Index
     */
    public function actionIndex()
    {
        // pending projects
        $criteria = new CDbCriteria;
        $criteria->with = array(
            'meta' => array(
                'select' => false,
                'together' => true,
                'condition' => '`project_meta`.`key` = :key AND `project_meta`.`value` > :value',
                'params' => array(
                    ':key' => 'create_time',
                    ':value' => time() - strtotime('1 month'),
                ),
            ),
        );
        $criteria->condition = '`project`.`status` < :status AND `project`.`active` = :active';
        $criteria->params = array(
            ':status' => ProjectModel::STATUS_COMPLETE,
            ':active' => true,
        );
        $criteria->limit = 30;

        $pendingProjects = ProjectModel::model()->findAll($criteria);

        // finished projects
        $criteria = new CDbCriteria;
        $criteria->with = array(
            'meta' => array(
                'select' => false,
                'together' => true,
                'condition' => '`project_meta`.`key` = :key AND `project_meta`.`value` > :value',
                'params' => array(
                    ':key' => 'create_time',
                    ':value' => time() - strtotime('1 month'),
                ),
            ),
        );
        $criteria->condition = '`project`.`status` = :status AND `project`.`active` = :active';
        $criteria->params = array(
            ':status' => ProjectModel::STATUS_COMPLETE,
            ':active' => true,
        );
        $criteria->limit = 30;

        $finishedProjects = ProjectModel::model()->findAll($criteria);

        $this->render('index', array(
            'pendingProjects' => $pendingProjects,
            'finishedProjects' => $finishedProjects,
        ));
    }
}