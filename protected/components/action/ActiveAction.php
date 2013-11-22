<?php

/**
 * Class ActiveAction
 */
class ActiveAction extends Action
{
    /**
     * Run action
     *
     * @param integer $id
     * @param string $redirectUrl
     * @throws CHttpException
     */
    public function run($id, $redirectUrl = null)
    {
        // get database model
        $dbModel = Model::model($this->modelName)->findByPk($id);
        if (null === $dbModel)
            throw new CHttpException(404, Yii::t('wojia', 'The requested page does not exist.'));

        // trigger entry
        $dbModel->active = $dbModel->active ? false : true;
        $dbModel->save(array('active'));

        // ajax response
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode(array('success' => true));
            Yii::app()->end();
        }

        // set active flash
        Yii::app()->user->setFlash('active', true);

        // redirect
        $this->controller->redirect($redirectUrl ? $redirectUrl : array('index'));
    }
}