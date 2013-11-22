<?php

/**
 * Class UpdateAction
 */
class UpdateAction extends Action
{
    /**
     * Run action
     *
     * @param integer $id
     * @throws CHttpException
     */
    public function run($id)
    {
        // set form model
        $this->setForm(new $this->formName);

        // set database model
        $model = Model::model($this->modelName)->findByPk($id);
        if (null === $model)
            throw new CHttpException(404, Yii::t('wojia', 'The requested page does not exist.'));

        // set & populate model
        $this->form->setModel($model);
        $this->form->populate();

        // get form attributes
        if ($attributes = Yii::app()->request->getPost($this->formName)) {
            // set form attributes
            $this->form->setAttributes($attributes);

            if ($this->form->save()) {
                // set updated flash
                Yii::app()->user->setFlash('update', true);

                // redirect
                $this->controller->redirect(
                    $this->redirectUrl ?
                        $this->redirectUrl :
                        array(
                            'update',
                            'id' => $this->form->id,
                        )
                );
            }
        }

        // render
        $this->render(array(
            'form' => $this->form,
        ));
    }
}