<?php

/**
 * Class MemberForm
 *
 * @property MemberModel $model
 */
abstract class MemberForm extends UserForm
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
                'id' => Yii::t('wojia', 'Member ID'),
                'name' => Yii::t('wojia', 'Member name'),
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