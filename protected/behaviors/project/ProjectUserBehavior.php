<?php

/**
 * Class ProjectUserBehavior
 */
class ProjectUserBehavior extends Behavior
{
    /**
     * After save
     *
     * @param CModelEvent $event
     */
    public function afterSave($event)
    {
        $userModel = UserModel::model()->findByPk($this->owner->user_id);
        $projectModel = ProjectModel::model()->findByPk($this->owner->project_id);

        // add log
        $this->addLog(
            $this->owner->project_id,
            Yii::t(
                'wojia',
                'Add :role ":name"',
                array(
                    ':role' => $userModel->getMeta('role'),
                    ':name' => $userModel->name,
                )
            )
        );

        // send email
        if (
            (
                isset($_POST['ProjectCreateForm']) &&
                isset($_POST['ProjectCreateForm']['notification']) &&
                $_POST['ProjectCreateForm']['notification']
            )
            ||
            (
                isset($_POST['ProjectUpdateForm']) &&
                isset($_POST['ProjectUpdateForm']['notification']) &&
                $_POST['ProjectUpdateForm']['notification']
            )
        )
            $this->mail(
                $userModel->email,
                Yii::t('wojia', 'You are assigned to a new project'),
                Yii::app()->controller->renderPartial('webroot.themes.wojia.views.mails.project-user', array(
                    'userModel' => $userModel,
                    'projectModel' => $projectModel,
                ), true)
            );
    }

    /**
     * After delete
     *
     * @param CEvent $event
     */
    public function afterDelete($event)
    {
        $model = UserModel::model()->findByPk($this->owner->user_id);

        // add log
        $this->addLog(
            $this->owner->project_id,
            Yii::t(
                'wojia',
                'Delete :role ":name"',
                array(
                    ':role' => $model->getMeta('role'),
                    ':name' => $model->name,
                )
            )
        );
    }
}