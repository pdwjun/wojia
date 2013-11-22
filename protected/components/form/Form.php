<?php

/**
 * Class Form
 *
 * @property Model $dbModel
 */
abstract class Form extends CFormModel
{
    /**
     * @var Model
     */
    private $_model;

    /**
     * Get model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * Set model
     *
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        // set model
        $this->_model = $model;

        // set model pk
        if (!$model->isNewRecord && property_exists($this, 'id'))
            $this->id = $model->id;

        return $this;
    }
}