<?php

/**
 * Class ServiceForm
 *
 * @property ServiceModel $model
 */
abstract class ServiceForm extends Form
{
    public $id;
    public $name;
    public $description;

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('wojia', 'Service ID'),
            'name' => Yii::t('wojia', 'Service name'),
            'description' => Yii::t('wojia', 'Description'),
        );
    }

    public function rules()
    {
        return array(
            array('name, description', 'required'),
        );
    }
}