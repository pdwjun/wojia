<?php

/**
 * Class CustomerModel
 */
class CustomerModel extends UserModel
{
    /**
     * CustomerModel instance
     *
     * @param string $className
     * @return CustomerModel
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Default scope
     *
     * @return array
     */
    public function defaultScope()
    {
        return CMap::mergeArray(
            parent::defaultScope(),
            array(
                'with' => array(
                    'meta' => array(
                        'together' => true,
                        'select' => false,
                        'condition' => 'user_meta.key = :key AND user_meta.value = :value',
                        'params' => array(
                            ':key' => 'role',
                            ':value' => UserMetaModel::ROLE_CUSTOMER,
                        ),
                    ),
                ),
            )
        );
    }
}