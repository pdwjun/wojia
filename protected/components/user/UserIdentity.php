<?php

/**
 * Class UserIdentity
 *
 * @property integer $id
 */
class UserIdentity extends CBaseUserIdentity
{
    const ERROR_EMAIL_INVALID = 1;
    private $_id;
    private $_email;
    private $_password;

    /**
     * Constructor
     *
     * @param string $email
     * @param string $password
     */
    public function __construct($email, $password)
    {
        $this->_email = $email;
        $this->_password = $password;
    }

    /**
     * Authenticate
     *
     * @return bool
     */
    public function authenticate()
    {
        $model = UserModel::model()->findByAttributes(array(
            'email' => $this->_email,
            'active' => true,
        ));
        if ($model === null)
            $this->errorCode = self::ERROR_EMAIL_INVALID;
        else if (!CPasswordHelper::verifyPassword($this->_password, $model->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $model->id;
            $this->errorCode = self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * Get user id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->_id;
    }
}