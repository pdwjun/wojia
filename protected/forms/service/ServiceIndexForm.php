<?php

class ServiceIndexForm extends ServiceForm
{
    public function rules()
    {
        return array(
            array('id, name, description', 'safe'),
        );
    }

    public function getDataProvider()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this->model, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->settings->services_per_page,
            ),
        ));
    }
}