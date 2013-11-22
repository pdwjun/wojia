<?php

/**
 * Class CustomerForm
 *
 * @property CustomerModel $model
 */
abstract class CustomerForm extends UserForm
{
    public $award;
    public $fax;
    public $address;
    public $company;
    public $tax;

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
                'id' => Yii::t('wojia', 'Customer ID'),
                'name' => Yii::t('wojia', 'Customer name'),
                'award' => Yii::t('wojia', 'Award'),
                'fax' => Yii::t('wojia', 'Fax'),
                'address' => Yii::t('wojia', 'Address'),
                'company' => Yii::t('wojia', 'Company'),
                'tax' => Yii::t('wojia', 'Tax code'),
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
                array('award, fax, company, address, tax', 'safe'),
            )
        );
    }
}