<?php

/**
 * Class IndexAction
 */
class IndexAction extends Action
{
    /**
     * Run action
     */
    public function run()
    {
        // set form
        $this->setForm(new $this->formName);

        // set model
        $this->form->setModel(new $this->modelName);

        // set form attributes
        $this->form->unsetAttributes();
        if ($attributes = Yii::app()->request->getQuery($this->formName))
            $this->form->setAttributes($attributes);

        // render
        $this->render(array(
            'form' => $this->form,
        ));
    }
}