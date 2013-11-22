<?php

/**
 * Class OptionModel
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $language
 */
class OptionModel extends Model
{
    /**
     * OptionModel instance
     *
     * @param string $className
     * @return OptionModel
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
        return 'option';
    }
}