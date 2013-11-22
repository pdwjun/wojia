<?php

/**
 * Class ServiceModel
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $active
 */
class ServiceModel extends Model
{
    /**
     * ServiceModel instance
     *
     * @param string $className
     * @return ServiceModel
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
        return 'service';
    }
}