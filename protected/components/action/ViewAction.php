<?php

/**
 * Class ViewAction
 */
class ViewAction extends Action
{
    /**
     * Run
     *
     * @param integer $id
     * @throws CHttpException
     */
    public function run($id)
    {
        $model = Model::model($this->modelName)->findByPk($id);
        if (null === $model)
            throw new CHttpException(404, Yii::t('wojia', 'The requested page does not exist.'));

        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial(array('model' => $model));
        else
            $this->render(array('model' => $model));
    }
}