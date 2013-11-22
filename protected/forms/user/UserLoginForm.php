<?php

/**
 * Class UserLoginForm
 */
class UserLoginForm extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe;
    protected $_identity;

    /**
     * Rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('email', 'email'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    /**
     * Attribute labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'email' => Yii::t('wojia', 'Email'),
            'password' => Yii::t('wojia', 'Password'),
            'rememberMe' => Yii::t('wojia', 'Remember me next time'),
        );
    }

    /**
     * Authenticate
     *
     * @param string $attribute
     * @param array $params
     */
    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->email, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', Yii::t('wojia', 'Incorrect email or password.'));
    }

    /**
     * Login
     *
     * @return bool
     */
    public function login()
    {
        if (null === $this->_identity) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }

        return false;
    }
}