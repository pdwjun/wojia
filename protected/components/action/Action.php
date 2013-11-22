<?php

/**
 * Class Action
 *
 * @property Form $form
 */
abstract class Action extends CAction
{
    public $formName;
    public $modelName;
    public $viewName;
    public $redirectUrl;
    private $_form;

    /**
     * Render view
     *
     * @param array $data
     */
    public function render(array $data = null)
    {
        $this->controller->render(
            $this->viewName ? $this->viewName : $this->controller->action->id,
            $data
        );
    }

    /**
     * Render partial
     *
     * @param array $data
     */
    public function renderPartial(array $data = null)
    {
        $this->controller->renderPartial(
            $this->viewName ? $this->viewName : $this->controller->action->id,
            $data
        );
    }

    /**
     * Get form model
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * Set form model
     *
     * @param Form $form
     * @return $this
     */
    public function setForm(Form $form)
    {
        $this->_form = $form;
        return $this;
    }
}