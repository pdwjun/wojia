<?php

/**
 * Class UserMetaModel
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $key
 * @property string $value
 */
class UserMetaModel extends Model
{
    const ROLE_CUSTOMER = 'customer';
    const ROLE_MEMBER = 'member';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMINISTRATOR = 'administrator';

    /**
     * UserMetaModel instance
     *
     * @param string $className
     * @return UserMetaModel
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Table name
     *
     * @return string
     */
    public function tableName()
    {
        return 'user_meta';
    }
}