<?php

/**
 * Class ManagerForm
 *
 * @property ManagerModel $model
 */
abstract class ManagerForm extends UserForm
{
    public $address;
    public $resume;

    /**
     * Attribute labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return CMap::mergeArray(
            parent::attributeLabels(),
            array(
                'id' => Yii::t('wojia', 'Manager ID'),
                'name' => Yii::t('wojia', 'Manager name'),
                'address' => Yii::t('wojia', 'Address'),
                'resume' => Yii::t('wojia', 'Resume'),
            )
        );
    }

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
                array('address, resume', 'safe'),
            )
        );
    }
}