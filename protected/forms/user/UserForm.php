<?php

/**
 * Class UserForm
 *
 * @property UserModel $model
 */
abstract class UserForm extends Form
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $comment;
    public $create_time;
    public $update_time;
    public $telephone;
    public $mobile;
    public $language;

    /**
     * Attribute labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('wojia', 'User ID'),
            'name' => Yii::t('wojia', 'User name'),
            'email' => Yii::t('wojia', 'Email'),
            'password' => Yii::t('wojia', 'Password'),
            'role' => Yii::t('wojia', 'Role'),
            'comment' => Yii::t('wojia', 'Comment'),
            'create_time' => Yii::t('wojia', 'Create time'),
            'update_time' => Yii::t('wojia', 'Update time'),
            'telephone' => Yii::t('wojia', 'Telephone'),
            'mobile' => Yii::t('wojia', 'Mobile'),
            'language' => Yii::t('wojia', 'Language'),
        );
    }

    /**
     * Rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('name, email', 'required'),
            array('email', 'email'),
            array('role, comment, create_time, update_time, telephone, mobile', 'safe'),
            array('language', 'in', 'range' => array_keys(self::getLanguageList())),
        );
    }

    /**
     * Language list
     *
     * @return array
     */
    public static function getLanguageList()
    {
        return array(
            'en' => Yii::t('wojia', 'English'),
            'zh_cn' => Yii::t('wojia', 'Chinese'),
        );
    }
}