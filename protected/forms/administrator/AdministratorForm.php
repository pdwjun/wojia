<?php

/**
 * Class AdministratorForm
 *
 * @property AdministratorModel $model
 */
abstract class AdministratorForm extends UserForm
{
    public $department;

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
                'id' => Yii::t('wojia', 'Administrator ID'),
                'name' => Yii::t('wojia', 'Administrator name'),
                'department' => Yii::t('wojia', 'Department'),
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
                array('department', 'safe'),
            )
        );
    }
}