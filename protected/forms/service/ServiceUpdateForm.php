<?php

/**
 * Class ServiceUpdateForm
 */
class ServiceUpdateForm extends ServiceForm
{
    /**
     * Populate
     */
    public function populate()
    {
        $this->name = $this->model->name;
        $this->description = $this->model->description;
    }

    /**
     * Save
     *
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $this->model->name = $this->name;
            $this->model->description = $this->description;
            $this->model->save();

            return true;
        } else
            return false;
    }
}