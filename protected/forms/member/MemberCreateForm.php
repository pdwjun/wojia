<?php

/**
 * Class MemberCreateForm
 */
class MemberCreateForm extends MemberForm
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
                'role' => UserMetaModel::ROLE_MEMBER,
                'create_time' => $time,
                'update_time' => $time,
                'comment' => $this->comment,
                'telephone' => $this->telephone,
                'mobile' => $this->mobile,
                'address' => $this->address,
                'resume' => $this->resume,
                'language' => $this->language,
            ));

            $this->id = $this->model->id;
            return true;
        } else
            return false;
    }
}