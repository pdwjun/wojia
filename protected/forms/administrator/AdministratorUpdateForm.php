<?php

/**
 * Class AdministratorUpdateForm
 */
class AdministratorUpdateForm extends AdministratorForm
{
    /**
     * Populate
     */
    public function populate()
    {
        $this->name = $this->model->name;
        $this->email = $this->model->email;

        foreach ($this->model->meta as $meta) {
            if (property_exists($this, $meta->key))
                $this->{$meta->key} = $meta->value;
        }
    }

    /**
     * Rules
     *
     * @return array
     */
    public function rules()
    {
        return CMap::mergeArray(
            parent::rules(),
            array(
                array('password', 'safe'),
                array('email', 'unique', 'className' => 'UserModel', 'criteria' => array(
                    'condition' => '`user`.`id` != :id',
                    'params' => array(':id' => $this->id),
                )),
            )
        );
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
            $this->model->email = $this->email;
            if ($this->password)
                $this->model->password = CPasswordHelper::hashPassword($this->password);
            $this->model->save();

            $this->model->setMeta(array(
                'update_time' => time(),
                'comment' => $this->comment,
                'telephone' => $this->telephone,
                'mobile' => $this->mobile,
                'department' => $this->department,
                'language' => $this->language,
            ));

            return true;
        } else
            return false;
    }
}