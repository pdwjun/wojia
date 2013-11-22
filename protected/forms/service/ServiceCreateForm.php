<?php

/**
 * Class ServiceCreateForm
 */
class ServiceCreateForm extends ServiceForm
{
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

            $this->id = $this->model->id;
            return true;
        } else
            return false;
    }
}