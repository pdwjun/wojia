<?php

/**
 * Class CreateAction
 */
class CreateAction extends Action
{
    /**
     * Run action
     */
    public function run()
    {
        // assign form & database models
        $this->setForm(new $this->formName);
        $this->form->setModel(new $this->modelName);

        // get form attributes
        if ($attributes = Yii::app()->request->getPost($this->formName)) {
            // set form attributes
            $this->form->setAttributes($attributes);

            if ($this->form->save()) {
                // set created flash
                Yii::app()->user->setFlash('create', true);

                // redirect
                $this->controller->redirect(
                    $this->redirectUrl ?
                        $this->redirectUrl :
                        array(
                            'index',
                        )
                );
            }
        }

        // render view
        $this->render(array(
            'form' => $this->getForm(),
        ));
    }
}