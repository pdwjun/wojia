<?php

/**
 * Class CustomerCreateForm
 */
class CustomerCreateForm extends CustomerForm
{
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
                array('password', 'required'),
                array('email', 'unique', 'className' => 'UserModel'),
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
            $this->model->password = CPasswordHelper::hashPassword($this->password);
            $this->model->save();

            $time = time();
            $this->model->setMeta(array(
                'create_time' => $time,
                'update_time' => $time,
                'role' => UserMetaModel::ROLE_CUSTOMER,
                'comment' => $this->comment,
                'telephone' => $this->telephone,
                'mobile' => $this->mobile,
                'fax' => $this->fax,
                'company' => $this->company,
                'address' => $this->address,
                'tax' => $this->tax,
                'award' => $this->award,
                'language' => $this->language,
            ));

            $this->id = $this->model->id;
            return true;
        } else
            return false;
    }
}