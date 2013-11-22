<?php

/**
 * Class WebUser
 *
 * @property string $name
 * @property string $email
 *
 * @property UserModel $model
 * @property boolean $isCustomer
 * @property boolean $isMember
 * @property boolean $isManager
 * @property boolean $isAdministrator
 */
class WebUser extends CWebUser
{
    /**
     * @var UserModel
     */
    private $_model;

    /**
     * Get role
     *
     * @return null|string
     */
    public function getRole()
    {
        if ($this->model) {
            return $this->model->getMeta('role');
        } else
            return null;
    }

    /**
     * Get name
     *
     * @return null|string
     */
    public function getName()
    {
        if ($this->model)
            return $this->model->name;
        else
            return null;
    }

    /**
     * Get model
     *
     * @return UserModel
     */
    public function getModel()
    {
        if (!$this->isGuest && null === $this->_model)
            $this->_model = UserModel::model()->findByPk($this->id);
        return $this->_model;
    }

    /**
     * Get is customer
     *
     * @return bool
     */
    public function getIsCustomer()
    {
        return $this->role == UserMetaModel::ROLE_CUSTOMER;
    }

    /**
     * Get is member
     *
     * @return bool
     */
    public function getIsMember()
    {
        return $this->role == UserMetaModel::ROLE_MEMBER;
    }

    /**
     * Get is manager
     *
     * @return bool
     */
    public function getIsManager()
    {
        return $this->role == UserMetaModel::ROLE_MANAGER;
    }

    /**
     * Get is administrator
     *
     * @return bool
     */
    public function getIsAdministrator()
    {
        return $this->role == UserMetaModel::ROLE_ADMINISTRATOR;
    }
}